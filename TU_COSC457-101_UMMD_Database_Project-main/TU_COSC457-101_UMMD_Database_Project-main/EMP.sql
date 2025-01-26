-- Create the database
CREATE DATABASE MedicalDB;
USE MedicalDB;

-- 1. Users Table (No dependencies)
CREATE TABLE Users (
                       user_id INT PRIMARY KEY AUTO_INCREMENT,
                       username VARCHAR(50) UNIQUE NOT NULL,
                       password_hash VARCHAR(255) NOT NULL,
                       email VARCHAR(100) UNIQUE NOT NULL,
                       role ENUM('doctor', 'nurse', 'admin', 'patient') DEFAULT 'patient',
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Insurance (No dependencies)
CREATE TABLE Insurance (
                           insurance_id INT PRIMARY KEY AUTO_INCREMENT,
                           provider_name VARCHAR(50),
                           policy_number VARCHAR(50),
                           coverage_details TEXT
);

-- 3. Specializations (No dependencies)
CREATE TABLE Specializations (
                                 specialization_id INT PRIMARY KEY AUTO_INCREMENT,
                                 name VARCHAR(100),
                                 description TEXT
);

-- 4. Departments (No dependencies)
CREATE TABLE Departments (
                             department_id INT PRIMARY KEY AUTO_INCREMENT,
                             name VARCHAR(50),
                             description TEXT
);

-- 5. Medications (No dependencies)
CREATE TABLE Medications (
                             medication_id INT PRIMARY KEY AUTO_INCREMENT,
                             name VARCHAR(50),
                             description TEXT
);

-- 6. Treatments (No dependencies)
CREATE TABLE Treatments (
                            treatment_id INT PRIMARY KEY AUTO_INCREMENT,
                            name VARCHAR(100),
                            description TEXT,
                            cost DECIMAL(10, 2)
);

-- 7. Tests (No dependencies)
CREATE TABLE Tests (
                       test_id INT PRIMARY KEY AUTO_INCREMENT,
                       name VARCHAR(100),
                       description TEXT,
                       cost DECIMAL(10, 2)
);

-- 8. Laboratories (Depends on Departments)
CREATE TABLE Laboratories (
                              lab_id INT PRIMARY KEY AUTO_INCREMENT,
                              name VARCHAR(50),
                              department_id INT,
                              FOREIGN KEY (department_id) REFERENCES Departments(department_id)
);

-- 9. Patients (Depends on Users and Insurance)
CREATE TABLE Patients (
                          patient_id INT PRIMARY KEY AUTO_INCREMENT,
                          user_id INT DEFAULT NULL,
                          first_name VARCHAR(50),
                          last_name VARCHAR(50),
                          birth_date DATE,
                          gender ENUM('Male', 'Female', 'Other'),
                          address TEXT,
                          phone VARCHAR(15),
                          insurance_id INT,
                          FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE SET NULL,
                          FOREIGN KEY (insurance_id) REFERENCES Insurance(insurance_id)
);

-- 10. Doctors (Depends on Users and Specializations)
CREATE TABLE Doctors (
                         doctor_id INT PRIMARY KEY AUTO_INCREMENT,
                         user_id INT,
                         first_name VARCHAR(50),
                         last_name VARCHAR(50),
                         specialization_id INT,
                         FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
                         FOREIGN KEY (specialization_id) REFERENCES Specializations(specialization_id)
);

-- 11. Nurses (Depends on Users and Departments)
CREATE TABLE Nurses (
                        nurse_id INT PRIMARY KEY AUTO_INCREMENT,
                        user_id INT,
                        first_name VARCHAR(50),
                        last_name VARCHAR(50),
                        department_id INT,
                        FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
                        FOREIGN KEY (department_id) REFERENCES Departments(department_id)
);

-- 12. Wards (Depends on Departments)
CREATE TABLE Wards (
                       ward_id INT PRIMARY KEY AUTO_INCREMENT,
                       name VARCHAR(50),
                       department_id INT,
                       FOREIGN KEY (department_id) REFERENCES Departments(department_id)
);

-- 13. Equipment (Depends on Departments)
CREATE TABLE Equipment (
                           equipment_id INT PRIMARY KEY AUTO_INCREMENT,
                           name VARCHAR(50),
                           description TEXT,
                           department_id INT,
                           FOREIGN KEY (department_id) REFERENCES Departments(department_id)
);

-- 14. Appointments (Depends on Patients and Doctors)
CREATE TABLE Appointments (
                              appointment_id INT PRIMARY KEY AUTO_INCREMENT,
                              patient_id INT,
                              doctor_id INT,
                              appointment_date DATETIME,
                              status ENUM('Scheduled', 'Completed', 'Cancelled'),
                              FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE,
                              FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id) ON DELETE CASCADE
);

-- 15. Prescriptions (Depends on Patients, Doctors, and Medications)
CREATE TABLE Prescriptions (
                               prescription_id INT PRIMARY KEY AUTO_INCREMENT,
                               patient_id INT,
                               doctor_id INT,
                               medication_id INT,
                               dosage VARCHAR(50),
                               start_date DATE,
                               end_date DATE,
                               FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE,
                               FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id) ON DELETE CASCADE,
                               FOREIGN KEY (medication_id) REFERENCES Medications(medication_id) ON DELETE CASCADE
);

-- 16. Diagnosis (Depends on Patients and Doctors)
CREATE TABLE Diagnosis (
                           diagnosis_id INT PRIMARY KEY AUTO_INCREMENT,
                           patient_id INT,
                           doctor_id INT,
                           description TEXT,
                           date DATE,
                           FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE,
                           FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id) ON DELETE CASCADE
);

-- 17. Bills (Depends on Patients)
CREATE TABLE Bills (
                       bill_id INT PRIMARY KEY AUTO_INCREMENT,
                       patient_id INT,
                       amount DECIMAL(10, 2),
                       status ENUM('Paid', 'Unpaid'),
                       date DATE,
                       FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE
);

-- 18. Emergency Contacts (Depends on Patients)
CREATE TABLE EmergencyContacts (
                                   contact_id INT PRIMARY KEY AUTO_INCREMENT,
                                   patient_id INT,
                                   name VARCHAR(50),
                                   relationship VARCHAR(20),
                                   phone VARCHAR(15),
                                   FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE
);

-- 19. Surgeries (Depends on Patients and Doctors)
CREATE TABLE Surgeries (
                           surgery_id INT PRIMARY KEY AUTO_INCREMENT,
                           patient_id INT,
                           doctor_id INT,
                           surgery_date DATE,
                           description TEXT,
                           FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE,
                           FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id) ON DELETE CASCADE
);

-- 20. Medical Records (Depends on Patients, Diagnosis, and Treatments)
CREATE TABLE MedicalRecords (
                                record_id INT PRIMARY KEY AUTO_INCREMENT,
                                patient_id INT,
                                diagnosis_id INT DEFAULT NULL,
                                treatment_id INT DEFAULT NULL,
                                FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE,
                                FOREIGN KEY (diagnosis_id) REFERENCES Diagnosis(diagnosis_id) ON DELETE SET NULL,
                                FOREIGN KEY (treatment_id) REFERENCES Treatments(treatment_id) ON DELETE SET NULL
);

-- 21. Staff Schedules (Depends on Users)
CREATE TABLE StaffSchedules (
                                schedule_id INT PRIMARY KEY AUTO_INCREMENT,
                                staff_id INT,
                                role ENUM('doctor', 'nurse'),
                                work_date DATE,
                                shift ENUM('Morning', 'Afternoon', 'Night'),
                                FOREIGN KEY (staff_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

-- 22. Doctor-Patient Relationship (Depends on Doctors and Patients)
CREATE TABLE DoctorPatient (
                               doctor_id INT,
                               patient_id INT,
                               PRIMARY KEY (doctor_id, patient_id),
                               FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id) ON DELETE CASCADE,
                               FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE
);

-- 23. Nurse-Patient Relationship (Depends on Nurses and Patients)
CREATE TABLE NursePatient (
                              nurse_id INT,
                              patient_id INT,
                              PRIMARY KEY (nurse_id, patient_id),
                              FOREIGN KEY (nurse_id) REFERENCES Nurses(nurse_id) ON DELETE CASCADE,
                              FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE
);
CREATE TABLE PatientTests (
                              patient_test_id INT PRIMARY KEY AUTO_INCREMENT,
                              patient_id INT NOT NULL,
                              test_id INT NOT NULL,
                              doctor_id INT,
                              order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
                              status ENUM('Ordered', 'In Progress', 'Completed', 'Cancelled') DEFAULT 'Ordered',
                              result TEXT,
                              FOREIGN KEY (patient_id) REFERENCES Patients(patient_id) ON DELETE CASCADE,
                              FOREIGN KEY (test_id) REFERENCES Tests(test_id) ON DELETE CASCADE,
                              FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id) ON DELETE CASCADE
);
