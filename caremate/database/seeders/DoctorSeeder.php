<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'Dr. Sarah Johnson',
                'specialization' => 'Cardiologist',
                'experience_years' => 15,
                'phone' => '+1-555-0101',
                'email' => 'sarah.johnson@caremate.com',
                'location' => 'New York Medical Center, NY',
                'consultation_fee' => 200.00,
                'availability' => ['Monday', 'Tuesday', 'Wednesday', 'Friday'],
                'bio' => 'Experienced cardiologist specializing in heart disease prevention and treatment. Board-certified with over 15 years of practice.',
            ],
            [
                'name' => 'Dr. Michael Chen',
                'specialization' => 'Dermatologist',
                'experience_years' => 10,
                'phone' => '+1-555-0102',
                'email' => 'michael.chen@caremate.com',
                'location' => 'Skin Care Clinic, CA',
                'consultation_fee' => 150.00,
                'availability' => ['Monday', 'Wednesday', 'Thursday', 'Friday'],
                'bio' => 'Expert dermatologist focused on skin cancer detection, acne treatment, and cosmetic dermatology procedures.',
            ],
            [
                'name' => 'Dr. Emily Rodriguez',
                'specialization' => 'Pediatrician',
                'experience_years' => 12,
                'phone' => '+1-555-0103',
                'email' => 'emily.rodriguez@caremate.com',
                'location' => 'Children\'s Health Center, TX',
                'consultation_fee' => 120.00,
                'availability' => ['Tuesday', 'Wednesday', 'Thursday', 'Saturday'],
                'bio' => 'Dedicated pediatrician with expertise in child development, vaccinations, and pediatric emergency care.',
            ],
            [
                'name' => 'Dr. David Wilson',
                'specialization' => 'Orthopedic Surgeon',
                'experience_years' => 20,
                'phone' => '+1-555-0104',
                'email' => 'david.wilson@caremate.com',
                'location' => 'Orthopedic Institute, FL',
                'consultation_fee' => 300.00,
                'availability' => ['Monday', 'Tuesday', 'Thursday', 'Friday'],
                'bio' => 'Renowned orthopedic surgeon specializing in joint replacement, sports injuries, and spine surgery.',
            ],
            [
                'name' => 'Dr. Lisa Thompson',
                'specialization' => 'Psychiatrist',
                'experience_years' => 8,
                'phone' => '+1-555-0105',
                'email' => 'lisa.thompson@caremate.com',
                'location' => 'Mental Health Center, WA',
                'consultation_fee' => 180.00,
                'availability' => ['Monday', 'Wednesday', 'Friday', 'Saturday'],
                'bio' => 'Compassionate psychiatrist specializing in anxiety, depression, and cognitive behavioral therapy.',
            ],
            [
                'name' => 'Dr. James Anderson',
                'specialization' => 'General Practitioner',
                'experience_years' => 18,
                'phone' => '+1-555-0106',
                'email' => 'james.anderson@caremate.com',
                'location' => 'Family Medicine Clinic, IL',
                'consultation_fee' => 100.00,
                'availability' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'bio' => 'Experienced family doctor providing comprehensive primary care for patients of all ages.',
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
