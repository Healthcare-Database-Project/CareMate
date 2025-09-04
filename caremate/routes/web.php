<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\AppointmentController;
use App\Models\MedicineCatalogue;
use App\Http\Livewire\MedicineCart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineCatalogueController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup-doctors', function () {
    $doctors = [
        [
            'name' => 'Dr. Sarah Johnson',
            'email' => 'sarah.johnson@caremate.com',
            'phone_number' => '+1-555-0101',
            'gender' => 'Female',
            'birth_date' => '1980-05-15',
            'password' => bcrypt('password123'),
            'role' => 'doctor',
            'specialization' => 'Cardiologist',
            'experience_years' => 15,
            'location' => 'New York Medical Center, NY',
            'consultation_fee' => 200.00,
            'availability' => ['Monday', 'Tuesday', 'Wednesday', 'Friday'],
            'bio' => 'Experienced cardiologist specializing in heart disease prevention and treatment.',
        ],
        [
            'name' => 'Dr. Michael Chen',
            'email' => 'michael.chen@caremate.com',
            'phone_number' => '+1-555-0102',
            'gender' => 'Male',
            'birth_date' => '1985-03-22',
            'password' => bcrypt('password123'),
            'role' => 'doctor',
            'specialization' => 'Dermatologist',
            'experience_years' => 10,
            'location' => 'Skin Care Clinic, CA',
            'consultation_fee' => 150.00,
            'availability' => ['Monday', 'Wednesday', 'Thursday', 'Friday'],
            'bio' => 'Expert dermatologist focused on skin cancer detection and acne treatment.',
        ],
        [
            'name' => 'Dr. Emily Rodriguez',
            'email' => 'emily.rodriguez@caremate.com',
            'phone_number' => '+1-555-0103',
            'gender' => 'Female',
            'birth_date' => '1983-11-08',
            'password' => bcrypt('password123'),
            'role' => 'doctor',
            'specialization' => 'Pediatrician',
            'experience_years' => 12,
            'location' => 'Children\'s Health Center, TX',
            'consultation_fee' => 120.00,
            'availability' => ['Tuesday', 'Wednesday', 'Thursday', 'Saturday'],
            'bio' => 'Dedicated pediatrician with expertise in child development and vaccinations.',
        ],
        [
            'name' => 'Dr. David Wilson',
            'email' => 'david.wilson@caremate.com',
            'phone_number' => '+1-555-0104',
            'gender' => 'Male',
            'birth_date' => '1975-09-12',
            'password' => bcrypt('password123'),
            'role' => 'doctor',
            'specialization' => 'Orthopedic Surgeon',
            'experience_years' => 20,
            'location' => 'Orthopedic Institute, FL',
            'consultation_fee' => 300.00,
            'availability' => ['Monday', 'Tuesday', 'Thursday', 'Friday'],
            'bio' => 'Renowned orthopedic surgeon specializing in joint replacement and sports injuries.',
        ],
        [
            'name' => 'Dr. Lisa Thompson',
            'email' => 'lisa.thompson@caremate.com',
            'phone_number' => '+1-555-0105',
            'gender' => 'Female',
            'birth_date' => '1987-07-30',
            'password' => bcrypt('password123'),
            'role' => 'doctor',
            'specialization' => 'General Practitioner',
            'experience_years' => 8,
            'location' => 'Family Medicine Clinic, WA',
            'consultation_fee' => 100.00,
            'availability' => ['Monday', 'Wednesday', 'Friday', 'Saturday'],
            'bio' => 'Compassionate family doctor providing comprehensive primary care for all ages.',
        ],
    ];

    $created = 0;
    foreach ($doctors as $doctor) {
        $existing = \App\Models\User::where('email', $doctor['email'])->first();
        if (!$existing) {
            \App\Models\User::create($doctor);
            $created++;
        }
    }

    return "Setup complete! Created {$created} doctors. <a href='/appointments'>View Doctors</a>";
});

Route::get('/run-migrations', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate');
        $output = \Illuminate\Support\Facades\Artisan::output();
        return "Migrations completed!<br><pre>{$output}</pre><br><a href='/setup-doctors'>Setup Doctors</a>";
    } catch (Exception $e) {
        return "Migration failed: " . $e->getMessage();
    }
});

Route::get('/reset-database', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh');
        $output = \Illuminate\Support\Facades\Artisan::output();
        return "Database reset completed!<br><pre>{$output}</pre><br><a href='/setup-doctors'>Setup Doctors</a>";
    } catch (Exception $e) {
        return "Database reset failed: " . $e->getMessage();
    }
});

Route::get('/dbconn', function () {
    return view('dbconn');
});

Route::get('/invoice', function () {
    return view('invoice');
});

Route::get('/medicinecatalogue', [MedicineCatalogueController::class, 'index'])->name('home');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Appointment routes
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::get('/my-appointments', [AppointmentController::class, 'myAppointments'])->name('appointments.my');

