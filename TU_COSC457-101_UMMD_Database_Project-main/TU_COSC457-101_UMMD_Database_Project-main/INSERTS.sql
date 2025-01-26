-- Default Users (Doctors, nurses, and patients that are predefined) --
INSERT INTO Users (user_id, username, password_hash, email, role) VALUES
                                                                      (1, 'Brown.Emily', '$2y$10PLACEHOLDER', 'Brown.Emily@UMMD.com', 'doctor'),
                                                                      (2, 'Green.Michael', '$2y$10PLACEHOLDER', 'Green.Michael@UMMD.com', 'doctor'),
                                                                      (3, 'White.Susan', '$2y$10PLACEHOLDER', 'White.Susan@UMMD.com', 'doctor'),
                                                                      (4, 'JDoe_1985', '$2y$10PLACEHOLDER', 'JDoe_1985@gmail.com', DEFAULT),
                                                                      (5, 'SmitJ', '$2y$10PLACEHOLDER', 'JSmithySupreme@aol.com', DEFAULT),
                                                                      (6, 'AliceJohnson', '$2y$10PLACEHOLDER', 'AJ47@hotmail.com', DEFAULT),
                                                                      (7, 'Taylor.Olivia', '$2y$10PLACEHOLDER', 'Taylor.Olivia@UMMD.com', 'nurse'),
                                                                      (8, 'Wilson.Liam', '$2y$10PLACEHOLDER', 'Wilson.Liam@UMMD.com', 'nurse'),
                                                                      (9, 'Davis.Emma', '$2y$10PLACEHOLDER', 'Davis.Emma@UMMD.com', 'nurse');

-- Specializations
INSERT INTO Specializations (specialization_id, name, description) VALUES
                                                                       (1, 'Cardiology', 'Heart-related treatments and procedures'),
                                                                       (2, 'Orthopedics', 'Musculoskeletal system treatments'),
                                                                       (3, 'Neurology', 'Brain and nervous system treatments');

-- Departments
INSERT INTO Departments (department_id, name, description) VALUES
                                                               (1, 'Emergency', 'Emergency services and immediate care'),
                                                               (2, 'Cardiology', 'Heart-related treatments and procedures'),
                                                               (3, 'Orthopedics', 'Bone and muscle treatments');

-- Insurance
INSERT INTO Insurance (insurance_id, provider_name, policy_number, coverage_details) VALUES
                                                                                         (1, 'HealthCare Inc.', 'HC123456', 'Full Coverage'),
                                                                                         (2, 'SafeHealth', 'SH654321', 'Partial Coverage'),
                                                                                         (3, 'MediSure', 'MS987654', 'Full Coverage with Dental');

-- Patients
INSERT INTO Patients (patient_id, user_id, first_name, last_name, birth_date, gender, address, phone, insurance_id) VALUES
                                                                                                                        (1, 4, 'John', 'Doe', '1985-06-15', 'Male', '123 Maple Street', '555-1234', 1),
                                                                                                                        (2, 5, 'Jane', 'Smith', '1990-09-25', 'Female', '456 Oak Avenue', '555-5678', 2),
                                                                                                                        (3, 6, 'Alice', 'Johnson', '1975-12-05', 'Female', '789 Pine Road', '555-9012', 3);

-- Doctors
INSERT INTO Doctors (doctor_id, user_id, first_name, last_name, specialization_id) VALUES
                                                                                       (1, 1, 'Emily', 'Brown', 1),
                                                                                       (2, 2, 'Michael', 'Green', 2),
                                                                                       (3, 3, 'Susan', 'White', 3);

-- Nurses
INSERT INTO Nurses (nurse_id, user_id, first_name, last_name, department_id) VALUES
                                                                                 (1, 7, 'Olivia', 'Taylor', 1),
                                                                                 (2, 8, 'Liam', 'Wilson', 2),
                                                                                 (3, 9, 'Emma', 'Davis', 3);

-- Wards
INSERT INTO Wards (ward_id, name, department_id) VALUES
                                                     (1, 'ICU', 1),
                                                     (2, 'Cardiac Ward', 2),
                                                     (3, 'Orthopedic Ward', 3);

-- Medications
INSERT INTO Medications (medication_id, name, description) VALUES
                                                               (1, 'Aspirin', 'Pain reliever and anti-inflammatory'),
                                                               (2, 'Lipitor', 'Cholesterol-lowering medication'),
                                                               (3, 'Metformin', 'Blood sugar control for diabetes');

-- Treatments
INSERT INTO Treatments (treatment_id, name, description, cost) VALUES
                                                                   (1, 'Physical Therapy', 'Rehabilitation exercises', 150.00),
                                                                   (2, 'Chemotherapy', 'Cancer treatment', 2000.00),
                                                                   (3, 'Radiation Therapy', 'Cancer treatment using radiation', 2500.00);

-- Tests
INSERT INTO Tests (test_id, name, description, cost) VALUES
                                                         (1, 'Blood Test', 'Complete blood count', 100.00),
                                                         (2, 'MRI Scan', 'Magnetic resonance imaging', 500.00),
                                                         (3, 'X-Ray', 'Radiographic imaging', 200.00);

-- Laboratories
INSERT INTO Laboratories (lab_id, name, department_id) VALUES
                                                           (1, 'Central Lab', 1),
                                                           (2, 'Imaging Center', 2),
                                                           (3, 'Pathology Lab', 3);

-- Equipment
INSERT INTO Equipment (equipment_id, name, description, department_id) VALUES
                                                                           (1, 'ECG Machine', 'Electrocardiogram machine', 2),
                                                                           (2, 'X-Ray Machine', 'Radiographic imaging device', 3),
                                                                           (3, 'MRI Scanner', 'Magnetic resonance imaging device', 2);

-- Staff Schedules
INSERT INTO StaffSchedules (schedule_id, staff_id, role, work_date, shift) VALUES
                                                                               (1, 1, 'doctor', '2024-10-15', 'Morning'),
                                                                               (2, 8, 'nurse', '2024-10-16', 'Afternoon'),
                                                                               (3, 3, 'doctor', '2024-10-17', 'Night');

-- Diagnosis
INSERT INTO Diagnosis (diagnosis_id, patient_id, doctor_id, description, date) VALUES
                                                                                   (1, 1, 1, 'Diagnosed with hypertension', '2024-10-01'),
                                                                                   (2, 2, 2, 'Fractured left arm', '2024-10-05'),
                                                                                   (3, 3, 3, 'Migraine headaches', '2024-10-10');

-- Appointments
INSERT INTO Appointments (appointment_id, patient_id, doctor_id, appointment_date, status) VALUES
                                                                                               (1, 1, 1, '2024-10-15 09:00:00', 'Scheduled'),
                                                                                               (2, 2, 2, '2024-10-16 10:30:00', 'Completed'),
                                                                                               (3, 3, 3, '2024-10-17 14:00:00', 'Cancelled');

-- Prescriptions
INSERT INTO Prescriptions (prescription_id, patient_id, doctor_id, medication_id, dosage, start_date, end_date) VALUES
                                                                                                                    (1, 1, 1, 2, '10mg once daily', '2024-10-15', '2024-11-15'),
                                                                                                                    (2, 2, 2, 3, '500mg twice daily', '2024-10-16', '2024-11-16'),
                                                                                                                    (3, 3, 3, 1, '100mg as needed', '2024-10-17', '2024-11-17');

-- Medical Records
INSERT INTO MedicalRecords (record_id, patient_id, diagnosis_id, treatment_id) VALUES
                                                                                   (1, 1, 1, 2),
                                                                                   (2, 2, 2, 1),
                                                                                   (3, 3, 3, 3);

-- Emergency Contacts
INSERT INTO EmergencyContacts (contact_id, patient_id, name, relationship, phone) VALUES
                                                                                      (1, 1, 'Michael Doe', 'Brother', '555-1111'),
                                                                                      (2, 2, 'Laura Smith', 'Mother', '555-2222'),
                                                                                      (3, 3, 'Robert Johnson', 'Spouse', '555-3333');

-- Surgeries
INSERT INTO Surgeries (surgery_id, patient_id, doctor_id, surgery_date, description) VALUES
                                                                                         (1, 2, 2, '2024-10-20', 'Arm fracture repair surgery'),
                                                                                         (2, 1, 1, '2024-10-25', 'Heart bypass surgery'),
                                                                                         (3, 3, 3, '2024-10-30', 'Brain tumor removal');

-- Bills
INSERT INTO Bills (bill_id, patient_id, amount, status, date) VALUES
                                                                  (1, 1, 5000.00, 'Unpaid', '2024-10-26'),
                                                                  (2, 2, 1500.00, 'Paid', '2024-10-21'),
                                                                  (3, 3, 7000.00, 'Unpaid', '2024-11-01');

-- Doctor-Patient Relationships
INSERT INTO DoctorPatient (doctor_id, patient_id) VALUES
                                                      (1, 1),
                                                      (2, 2),
                                                      (3, 3);

-- Nurse-Patient Relationships
INSERT INTO NursePatient (nurse_id, patient_id) VALUES
                                                    (1, 2),
                                                    (2, 1),
                                                    (3, 3);

-- PatientTests
INSERT INTO PatientTests (patient_id, test_id, doctor_id, order_date, status, result) VALUES
                                                                                          (1, 1, 1, '2024-11-01 09:30:00', 'Ordered', NULL), -- John Doe, Blood Test, Ordered by Dr. Emily Brown
                                                                                          (2, 2, 2, '2024-11-02 10:00:00', 'In Progress', NULL), -- Jane Smith, MRI Scan, Ordered by Dr. Michael Green
                                                                                          (3, 3, 3, '2024-11-03 11:15:00', 'Completed', 'No fractures detected'), -- Alice Johnson, X-Ray, Ordered by Dr. Susan White
                                                                                          (1, 2, 1, '2024-11-04 08:45:00', 'Completed', 'Normal brain scan'), -- John Doe, MRI Scan, Ordered by Dr. Emily Brown
                                                                                          (2, 3, 2, '2024-11-05 12:30:00', 'Cancelled', NULL), -- Jane Smith, X-Ray, Ordered by Dr. Michael Green
                                                                                          (3, 1, 3, '2024-11-06 14:00:00', 'Completed', 'White blood cell count elevated'); -- Alice Johnson, Blood Test, Ordered by Dr. Susan White
