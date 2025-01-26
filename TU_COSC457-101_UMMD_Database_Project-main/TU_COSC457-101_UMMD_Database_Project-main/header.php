<!DOCTYPE html>
<html>
<head>
    <title>Medical Management System</title>
    <style>
        /* Basic styling for navigation menu */
        ul.nav {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        ul.nav li {
            float: left;
        }

        ul.nav li a {
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.nav li a:hover {
            background-color: #111;
        }

        /* Clear floats after the navigation */
        ul.nav::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <ul class="nav">
        <li><a href="/medicaldb/patient/view_patients.php">Patients</a></li>
        <li><a href="/medicaldb/doctor/view_doctors.php">Doctors</a></li>
        <li><a href="/medicaldb/nurse/view_nurses.php">Nurses</a></li>
        <li><a href="/medicaldb/medication/view_medications.php">Medications</a></li>
        <li><a href="/medicaldb/test/view_tests.php">Tests</a></li>
        <li><a href="/medicaldb/appointment/view_appointments.php">Appointments</a></li>
        <li><a href="/medicaldb/department/view_departments.php">Departments</a></li>
        <li><a href="/medicaldb/treatment/view_treatments.php">Treatments</a></li>
        <li><a href="/medicaldb/laboratory/view_laboratories.php">Laboratories</a></li>
        <li><a href="/medicaldb/ward/view_wards.php">Wards</a></li>
        <li><a href="/medicaldb/equipment/view_equipment.php">Equipment</a></li>
        <li><a href="/medicaldb/schedule/view_schedules.php">Staff Schedules</a></li>
        <li><a href="/medicaldb/login.php">Login</a></li>
        <li><a href="/medicaldb/register.php">Register</a></li>
        <li><a href="/medicaldb/reset_password.php">Reset Password</a></li>
    </ul>
    <hr>