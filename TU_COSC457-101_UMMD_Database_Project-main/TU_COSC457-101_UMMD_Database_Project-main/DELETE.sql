-- Switch to the database
USE MedicalDB;

-- Disable foreign key checks to allow dropping tables with dependencies
SET FOREIGN_KEY_CHECKS = 0;

-- Drop all tables
DROP TABLE IF EXISTS
    NursePatient,
    DoctorPatient,
    PatientTests,
    StaffSchedules,
    Equipment,
    Wards,
    Departments,
    Surgeries,
    EmergencyContacts,
    MedicalRecords,
    Insurance,
    Bills,
    Laboratories,
    Tests,
    Diagnosis,
    Treatments,
    Medications,
    Prescriptions,
    Appointments,
    Specializations,
    Nurses,
    Doctors,
    Patients,
    Users;

-- Re-enable foreign key checks
SET FOREIGN_KEY_CHECKS = 1;