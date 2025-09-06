<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Hospital;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\Hash;

class NewSchemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $adminUser = User::create([
            'first_name' => 'Admin',
            'last_name' => 'CareMate',
            'email' => 'admin@caremate.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        Admin::create([
            'users_id' => $adminUser->users_id,
            'admin_level' => 'super',
            'department' => 'IT Management',
        ]);

        // Create Hospitals
        $hospital1 = Hospital::create([
            'hospital_name' => 'CareMate General Hospital',
            'location' => 'Dhaka, Bangladesh',
            'phone' => '+880-2-9876543',
            'email' => 'info@caremategeneral.com',
            'type' => 'General',
        ]);

        $hospital2 = Hospital::create([
            'hospital_name' => 'CareMate Specialized Center',
            'location' => 'Chittagong, Bangladesh',
            'phone' => '+880-31-987654',
            'email' => 'info@carematespecialized.com',
            'type' => 'Specialized',
        ]);

        // Create Doctor Users and Doctor profiles
        $doctorUser1 = User::create([
            'first_name' => 'Dr. Sarah',
            'last_name' => 'Johnson',
            'email' => 'sarah.johnson@caremate.com',
            'password' => Hash::make('password123'),
            'role' => 'doctor',
        ]);

        $doctor1 = Doctor::create([
            'users_id' => $doctorUser1->users_id,
            'bmdc_reg_no' => 'BMDC12345',
            'specialization' => 'Cardiologist',
            'years_of_experience' => 15,
            'consultation_fee' => 2000.00,
            'education' => 'MBBS, MD (Cardiology)',
            'phone' => '+880-1711-123456',
        ]);

        $doctorUser2 = User::create([
            'first_name' => 'Dr. Michael',
            'last_name' => 'Chen',
            'email' => 'michael.chen@caremate.com',
            'password' => Hash::make('password123'),
            'role' => 'doctor',
        ]);

        $doctor2 = Doctor::create([
            'users_id' => $doctorUser2->users_id,
            'bmdc_reg_no' => 'BMDC12346',
            'specialization' => 'Dermatologist',
            'years_of_experience' => 10,
            'consultation_fee' => 1500.00,
            'education' => 'MBBS, MD (Dermatology)',
            'phone' => '+880-1711-123457',
        ]);

        $doctorUser3 = User::create([
            'first_name' => 'Dr. Emily',
            'last_name' => 'Rodriguez',
            'email' => 'emily.rodriguez@caremate.com',
            'password' => Hash::make('password123'),
            'role' => 'doctor',
        ]);

        $doctor3 = Doctor::create([
            'users_id' => $doctorUser3->users_id,
            'bmdc_reg_no' => 'BMDC12347',
            'specialization' => 'Pediatrician',
            'years_of_experience' => 8,
            'consultation_fee' => 1200.00,
            'education' => 'MBBS, MD (Pediatrics)',
            'phone' => '+880-1711-123458',
        ]);

        // Create Patient Users and Patient profiles
        $patientUser1 = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'),
            'role' => 'patient',
        ]);

        Patient::create([
            'users_id' => $patientUser1->users_id,
            'phone' => '+880-1711-567890',
            'age' => 35,
            'sex' => 'Male',
            'address' => 'Dhanmondi, Dhaka',
            'medical_history' => 'Hypertension, diabetes',
            'blood_group' => 'A+',
            'emergency_contact' => '+880-1711-567891',
        ]);

        $patientUser2 = User::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'password' => Hash::make('password123'),
            'role' => 'patient',
        ]);

        Patient::create([
            'users_id' => $patientUser2->users_id,
            'phone' => '+880-1711-567892',
            'age' => 28,
            'sex' => 'Female',
            'address' => 'Gulshan, Dhaka',
            'medical_history' => 'No major medical history',
            'blood_group' => 'B+',
            'emergency_contact' => '+880-1711-567893',
        ]);

        // Create Doctor Schedules
        DoctorSchedule::create([
            'doctor_id' => $doctor1->doctor_id,
            'day_of_week' => 'Monday',
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
            'max_appointments' => 8,
        ]);

        DoctorSchedule::create([
            'doctor_id' => $doctor1->doctor_id,
            'day_of_week' => 'Wednesday',
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
            'max_appointments' => 8,
        ]);

        DoctorSchedule::create([
            'doctor_id' => $doctor2->doctor_id,
            'day_of_week' => 'Tuesday',
            'start_time' => '10:00:00',
            'end_time' => '18:00:00',
            'max_appointments' => 10,
        ]);

        DoctorSchedule::create([
            'doctor_id' => $doctor3->doctor_id,
            'day_of_week' => 'Monday',
            'start_time' => '08:00:00',
            'end_time' => '16:00:00',
            'max_appointments' => 12,
        ]);

        // Associate doctors with hospitals (works_at relationship)
        $doctor1->hospitals()->attach($hospital1->hospital_id);
        $doctor2->hospitals()->attach($hospital1->hospital_id);
        $doctor3->hospitals()->attach($hospital2->hospital_id);
    }
}
