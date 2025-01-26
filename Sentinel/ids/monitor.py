import os
import psutil
import json
from watchdog.observers import Observer
from watchdog.events import FileSystemEventHandler
from rich.console import Console
from datetime import datetime
import hashlib
import tkinter as tk
from threading import Thread


rules_path = os.path.join(os.path.dirname(__file__), "rules.json")
if not os.path.exists(rules_path):
    raise FileNotFoundError(f"rules.json not found at {rules_path}")

with open(rules_path) as f:
    RULES = json.load(f)

console = Console()

# logs directory
logs_path = os.path.join(os.path.dirname(__file__), "logs")
log_file_path = os.path.join(logs_path, "alerts.log")
if not os.path.exists(logs_path):
    os.makedirs(logs_path)

class IntrusionHandler(FileSystemEventHandler):
    def on_created(self, event):
        check_file(event.src_path)

    def on_modified(self, event):
        check_file(event.src_path)

def log_alert(message, metadata):
    timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    log_message = f"[{timestamp}] {message} | Metadata: {metadata}"
    console.log(f"[red]{log_message}[/red]")
    with open(log_file_path, "a") as log_file:
        log_file.write(log_message + "\n")

def check_file(file_path):
    if not os.path.isfile(file_path):
        return

    # check if file matches any malicious patterns by calculating hash
    for pattern in RULES["filesystem"]:
        if pattern in file_path:
            
            file_hash = calculate_file_hash(file_path)
            metadata = {
                "type": "File Pattern Match",
                "path": file_path,
                "hash": file_hash,
                "action": "Deleted",
                "timestamp": datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            }

            # log and remove the file
            log_alert(f"Malware detected: {file_path}", metadata)
            os.remove(file_path)
            console.log(f"[bold red]File {file_path} has been removed![/bold red]")
            break

def calculate_file_hash(file_path):
    """Calculate SHA256 hash of a file."""
    sha256_hash = hashlib.sha256()
    with open(file_path, "rb") as f:
        for byte_block in iter(lambda: f.read(4096), b""):
            sha256_hash.update(byte_block)
    return sha256_hash.hexdigest()

def monitor_filesystem():
    event_handler = IntrusionHandler()
    observer = Observer()
    observer.schedule(event_handler, path=".", recursive=True)
    observer.start()
    return observer

def monitor_processes():
    malicious_signatures = RULES["process"]
    while True:
        for proc in psutil.process_iter(['name', 'cmdline']):
            try:
                cmdline = proc.info['cmdline'] or [] 
                if any(sig in cmdline for sig in malicious_signatures):
                    metadata = {
                        "type": "Process Signature Match",
                        "name": proc.info['name'],
                        "cmdline": proc.info['cmdline'],
                        "timestamp": datetime.now().strftime("%Y-%m-%d %H:%M:%S")
                    }
                    log_alert(f"Malicious process detected: {proc.info['name']}", metadata)
                    
                    proc.terminate()
            except (psutil.NoSuchProcess, psutil.AccessDenied):
                continue

# GUI code
def start_gui():
    def update_logs():
        try:
            with open(log_file_path, "r") as log_file:
                logs = log_file.readlines()
                log_text.delete("1.0", tk.END)
                log_text.insert(tk.END, "".join(logs))
        except FileNotFoundError:
            log_text.delete("1.0", tk.END)
            log_text.insert(tk.END, "No logs available yet.")

        root.after(2000, update_logs)  # logs refreshed every 2 seconds

    # gui window
    root = tk.Tk()
    root.title("CyberSentinel - Log Viewer")
    root.geometry("800x400")

    log_text = tk.Text(root, wrap=tk.WORD, state=tk.NORMAL, bg="black", fg="green")
    log_text.pack(expand=True, fill=tk.BOTH)

    update_logs()
    root.mainloop()

if __name__ == "__main__":
    
    gui_thread = Thread(target=start_gui, daemon=True)
    gui_thread.start()

    console.log("[green]CyberSentinel: Intrusion Detection System is running...[/green]")
    observer = monitor_filesystem()
    try:
        monitor_processes()
    except KeyboardInterrupt:
        observer.stop()
    observer.join()
