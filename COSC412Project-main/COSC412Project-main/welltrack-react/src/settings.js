import React, { useState } from 'react';

function Settings() {
    const [settings, setSettings] = useState({
        name: '',
        age: '',
        gender: 'male',
        weight: '',
        height: '',
        email: '',
        password: '',
        notifications: false,
        profileVisibility: 'public',
        dataSharing: false,
        measurementUnits: 'metric',
        language: 'en',
        theme: 'light',
        feedback: '',
    });

    const handleChange = (event) => {
        const { name, value, type, checked } = event.target;
        setSettings(prev => ({
            ...prev,
            [name]: type === 'checkbox' ? checked : value
        }));
    };

    const handleSubmitFeedback = () => {
        alert('Feedback submitted: ' + settings.feedback);
    };

    const handleDownloadData = () => {
        alert('Downloading data...');
    };

    const handleDeleteAccount = () => {
        if (window.confirm('Are you sure you want to delete your account?')) {
            alert('Account deleted.');
        }
    };

    const handleLogout = () => {
        alert('Logging out...');
    };

    const styles = {
        container: {
            fontFamily: 'Arial, sans-serif',
            backgroundColor: '#121212',
            color: 'white',
            margin: 0,
            padding: 20,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            minHeight: '100vh',
        },
        input: {
            width: 'calc(100% - 22px)',
            padding: 10,
            marginTop: 5,
            border: 'none',
            borderRadius: 4,
            backgroundColor: '#222',
            color: 'white',
        },
        button: {
            backgroundColor: '#e91e63',
            color: 'white',
            border: 'none',
            padding: '8px 16px',
            cursor: 'pointer',
            width: '100%',
            borderRadius: 4,
            marginTop: 10,
        },
        select: {
            width: 'calc(100% - 22px)',
            padding: 10,
            marginTop: 5,
            border: 'none',
            borderRadius: 4,
            backgroundColor: '#222',
            color: 'white',
        },
        checkbox: {
            margin: '5px 10px 5px 0',
        },
        textarea: {
            width: 'calc(100% - 22px)',
            padding: 10,
            border: 'none',
            borderRadius: 4,
            backgroundColor: '#222',
            color: 'white',
            marginTop: 5,
        }
    };

    return (
        <div style={styles.container}>
            <div>
                <h1>Settings</h1>
                <form id="settingsForm">
                    <div>
                        <label htmlFor="name">Name:</label>
                        <input type="text" id="name" name="name" value={settings.name} onChange={handleChange} style={styles.input} />
                    </div>

                    <div>
                        <label htmlFor="age">Age:</label>
                        <input type="text" id="age" name="age" value={settings.age} onChange={handleChange} style={styles.input} />
                    </div>

                    <div>
                        <label htmlFor="gender">Gender:</label>
                        <select id="gender" name="gender" value={settings.gender} onChange={handleChange} style={styles.select}>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label htmlFor="weight">Weight (kg):</label>
                        <input type="text" id="weight" name="weight" value={settings.weight} onChange={handleChange} style={styles.input} />
                    </div>

                    <div>
                        <label htmlFor="height">Height (cm):</label>
                        <input type="text" id="height" name="height" value={settings.height} onChange={handleChange} style={styles.input} />
                    </div>

                    <h2>Account Settings</h2>
                    <div>
                        <label htmlFor="email">Email:</label>
                        <input type="text" id="email" name="email" value={settings.email} onChange={handleChange} style={styles.input} />
                    </div>

                    <div>
                        <label htmlFor="password">Password:</label>
                        <input type="password" id="password" name="password" value={settings.password} onChange={handleChange} style={styles.input}/>
                                                <input type="password" id="password" name="password" value={settings.password} onChange={handleChange} style={styles.input} />
                                                </div>
                            
                                                <h2>Notification Preferences</h2>
                                                <div>
                                                    <input type="checkbox" id="notifications" name="notifications" checked={settings.notifications} onChange={handleChange} style={styles.checkbox} />
                                                    <label htmlFor="notifications">Enable notifications</label>
                                                </div>
                            
                                                <h2>Privacy Settings</h2>
                                                <div>
                                                    <label htmlFor="profileVisibility">Profile Visibility:</label>
                                                    <select id="profileVisibility" name="profileVisibility" value={settings.profileVisibility} onChange={handleChange} style={styles.select}>
                                                        <option value="public">Public</option>
                                                        <option value="friends">Friends Only</option>
                                                        <option value="private">Private</option>
                                                    </select>
                                                </div>
                            
                                                <div>
                                                    <input type="checkbox" id="dataSharing" name="dataSharing" checked={settings.dataSharing} onChange={handleChange} style={styles.checkbox} />
                                                    <label htmlFor="dataSharing">Share workout data with friends</label>
                                                </div>
                            
                                                <h2>Preferences</h2>
                                                <div>
                                                    <label htmlFor="measurementUnits">Measurement Units:</label>
                                                    <select id="measurementUnits" name="measurementUnits" value={settings.measurementUnits} onChange={handleChange} style={styles.select}>
                                                        <option value="metric">Metric</option>
                                                        <option value="imperial">Imperial</option>
                                                    </select>
                                                </div>
                            
                                                <div>
                                                    <label htmlFor="language">Language:</label>
                                                    <select id="language" name="language" value={settings.language} onChange={handleChange} style={styles.select}>
                                                        <option value="en">English</option>
                                                        <option value="fr">French</option>
                                                        <option value="es">Spanish</option>
                                                        <option value="de">German</option>
                                                    </select>
                                                </div>
                            
                                                <h2>Appearance</h2>
                                                <div>
                                                    <label htmlFor="theme">Theme:</label>
                                                    <select id="theme" name="theme" value={settings.theme} onChange={handleChange} style={styles.select}>
                                                        <option value="light">Light Mode</option>
                                                        <option value="dark">Dark Mode</option>
                                                    </select>
                                                </div>
                            
                                                <h2>Data Management</h2>
                                                <div>
                                                    <button type="button" onClick={handleDownloadData} style={styles.button}>Download My Data</button>
                                                    <button type="button" onClick={handleDeleteAccount} style={styles.button}>Delete My Account</button>
                                                </div>
                            
                                                <h2>Feedback and Support</h2>
                                                <div>
                                                    <textarea id="feedback" name="feedback" rows="4" value={settings.feedback} onChange={handleChange} style={styles.textarea} placeholder="Enter your feedback"></textarea>
                                                    <button type="button" onClick={handleSubmitFeedback} style={styles.button}>Submit Feedback</button>
                                                </div>
                            
                                                <h2>Log Out</h2>
                                                <div>
                                                    <button type="button" onClick={handleLogout} style={styles.button}>Log Out</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                );
                            }
                            
                            export default Settings;
                            
