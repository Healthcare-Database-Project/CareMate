<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Doctor;

class CreateSampleDoctors extends Command
{
    protected $signature = 'doctors:create-samples';
    protected $description = 'Create 5 sample doctors for testing';

    public function handle()
    {
        $doctors = [
            [
                'name' => 'Dr. Sarah Johnson',
                'specialization' => 'Cardiologist',
                'experience_years' => 15,
                'phone' => '+1-555-0101',
                'email' => 'sarah.johnson@caremate.com',
                'location' => 'New York Medical Center, NY',
                'consultation_fee' => 1500.00,
                'availability' => ['Monday', 'Tuesday', 'Wednesday', 'Friday'],
                'bio' => 'Experienced cardiologist specializing in heart disease prevention and treatment.',
            ],
            [
                'name' => 'Dr. Michael Chen',
                'specialization' => 'Dermatologist',
                'experience_years' => 10,
                'phone' => '+1-555-0102',
                'email' => 'michael.chen@caremate.com',
                'location' => 'Skin Care Clinic, CA',
                'consultation_fee' => 500.00,
                'availability' => ['Monday', 'Wednesday', 'Thursday', 'Friday'],
                'bio' => 'Expert dermatologist focused on skin cancer detection and acne treatment.',
            ],
            [
                'name' => 'Dr. Emily Rodriguez',
                'specialization' => 'Pediatrician',
                'experience_years' => 12,
                'phone' => '+1-555-0103',
                'email' => 'emily.rodriguez@caremate.com',
                'location' => 'Children\'s Health Center, TX',
                'consultation_fee' => 500.00,
                'availability' => ['Tuesday', 'Wednesday', 'Thursday', 'Saturday'],
                'bio' => 'Dedicated pediatrician with expertise in child development and vaccinations.',
            ],
            [
                'name' => 'Dr. David Wilson',
                'specialization' => 'Orthopedic Surgeon',
                'experience_years' => 20,
                'phone' => '+1-555-0104',
                'email' => 'david.wilson@caremate.com',
                'location' => 'Orthopedic Institute, FL',
                'consultation_fee' => 2000.00,
                'availability' => ['Monday', 'Tuesday', 'Thursday', 'Friday'],
                'bio' => 'Renowned orthopedic surgeon specializing in joint replacement and sports injuries.',
            ],
            [
                'name' => 'Dr. Lisa Thompson',
                'specialization' => 'General Practitioner',
                'experience_years' => 8,
                'phone' => '+1-555-0105',
                'email' => 'lisa.thompson@caremate.com',
                'location' => 'Family Medicine Clinic, WA',
                'consultation_fee' => 350.00,
                'availability' => ['Monday', 'Wednesday', 'Friday', 'Saturday'],
                'bio' => 'Compassionate family doctor providing comprehensive primary care for all ages.',
            ],
        ];

        foreach ($doctors as $doctor) {
            $existing = Doctor::where('email', $doctor['email'])->first();
            if (!$existing) {
                Doctor::create($doctor);
                $this->info("Created doctor: {$doctor['name']}");
            } else {
                $this->info("Doctor already exists: {$doctor['name']}");
            }
        }

        $this->info('Sample doctors created successfully!');
    }
}
