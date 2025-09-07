<?php

use App\Http\Controllers\AppointmentController;
use App\Models\MedicineCatalogue;
use App\Http\Livewire\MedicineCart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicineCatalogueController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-db', function () {
    try {
        $doctors = \App\Models\Doctor::with('user')->get();
        $patients = \App\Models\Patient::with('user')->get();
        $hospitals = \App\Models\Hospital::all();
        
        $output = "<h2>Database Test Results</h2>";
        $output .= "<h3>Doctors (" . $doctors->count() . "):</h3><ul>";
        foreach ($doctors as $doctor) {
            $output .= "<li>Dr. {$doctor->user->first_name} {$doctor->user->last_name} - {$doctor->specialization}</li>";
        }
        $output .= "</ul>";
        
        $output .= "<h3>Patients (" . $patients->count() . "):</h3><ul>";
        foreach ($patients as $patient) {
            $output .= "<li>{$patient->user->first_name} {$patient->user->last_name} - {$patient->blood_group}</li>";
        }
        $output .= "</ul>";
        
        $output .= "<h3>Hospitals (" . $hospitals->count() . "):</h3><ul>";
        foreach ($hospitals as $hospital) {
            $output .= "<li>{$hospital->hospital_name} - {$hospital->location}</li>";
        }
        $output .= "</ul>";
        
        $output .= "<br><a href='/appointments'>View Appointments</a> | <a href='/medicinecatalogue'>Medicine Catalogue</a>";
        
        return $output;
    } catch (Exception $e) {
        return "Database test failed: " . $e->getMessage();
    }
});

Route::get('/setup-doctors', function () {
    $doctors = [
        [
            'first_name' => 'Dr. Sarah',
            'last_name' => 'Johnson',
            'email' => 'sarah.johnson@caremate.com',
            'password' => bcrypt('password123'),
            'role' => 'doctor',
            'bmdc_reg_no' => 'BMDC10001',
            'specialization' => 'Cardiologist',
            'years_of_experience' => 15,
            'consultation_fee' => 2000.00,
            'education' => 'MBBS, MD (Cardiology)',
            'phone' => '+880-1711-100001',
        ],
        [
            'first_name' => 'Dr. Michael',
            'last_name' => 'Chen',
            'email' => 'michael.chen@caremate.com',
            'password' => bcrypt('password123'),
            'role' => 'doctor',
            'bmdc_reg_no' => 'BMDC10002',
            'specialization' => 'Dermatologist',
            'years_of_experience' => 10,
            'consultation_fee' => 1500.00,
            'education' => 'MBBS, MD (Dermatology)',
            'phone' => '+880-1711-100002',
        ],
        [
            'first_name' => 'Dr. Emily',
            'last_name' => 'Rodriguez',
            'email' => 'emily.rodriguez@caremate.com',
            'password' => bcrypt('password123'),
            'role' => 'doctor',
            'bmdc_reg_no' => 'BMDC10003',
            'specialization' => 'Pediatrician',
            'years_of_experience' => 12,
            'consultation_fee' => 1200.00,
            'education' => 'MBBS, MD (Pediatrics)',
            'phone' => '+880-1711-100003',
        ],
        [
            'first_name' => 'Dr. David',
            'last_name' => 'Wilson',
            'email' => 'david.wilson@caremate.com',
            'password' => bcrypt('password123'),
            'role' => 'doctor',
            'bmdc_reg_no' => 'BMDC10004',
            'specialization' => 'Orthopedic Surgeon',
            'years_of_experience' => 20,
            'consultation_fee' => 3000.00,
            'education' => 'MBBS, MS (Orthopedics)',
            'phone' => '+880-1711-100004',
        ],
        [
            'first_name' => 'Dr. Lisa',
            'last_name' => 'Thompson',
            'email' => 'lisa.thompson@caremate.com',
            'password' => bcrypt('password123'),
            'role' => 'doctor',
            'bmdc_reg_no' => 'BMDC10005',
            'specialization' => 'General Practitioner',
            'years_of_experience' => 8,
            'consultation_fee' => 1000.00,
            'education' => 'MBBS',
            'phone' => '+880-1711-100005',
        ],
    ];

    $created = 0;
    foreach ($doctors as $doctorData) {
        $existing = \App\Models\User::where('email', $doctorData['email'])->first();
        if (!$existing) {
            // Create User record
            $user = \App\Models\User::create([
                'first_name' => $doctorData['first_name'],
                'last_name' => $doctorData['last_name'],
                'email' => $doctorData['email'],
                'password' => $doctorData['password'],
                'role' => $doctorData['role'],
            ]);

            // Create Doctor record
            \App\Models\Doctor::create([
                'users_id' => $user->users_id,
                'bmdc_reg_no' => $doctorData['bmdc_reg_no'],
                'specialization' => $doctorData['specialization'],
                'years_of_experience' => $doctorData['years_of_experience'],
                'consultation_fee' => $doctorData['consultation_fee'],
                'education' => $doctorData['education'],
                'phone' => $doctorData['phone'],
            ]);

            $created++;
        }
    }

    return "Setup complete! Created {$created} doctors. <a href='/appointments'>View Doctors</a> | <a href='/test-db'>Test Database</a>";
});

Route::get('/setup-patient', function () {
    // Create a test patient
    $existing = \App\Models\User::where('email', 'patient@test.com')->first();
    if (!$existing) {
        $user = \App\Models\User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'patient@test.com',
            'password' => bcrypt('password123'),
            'role' => 'patient',
        ]);

        \App\Models\Patient::create([
            'users_id' => $user->users_id,
            'phone' => '+880-1711-567890',
            'age' => 35,
            'sex' => 'Male',
            'address' => 'Dhanmondi, Dhaka',
            'medical_history' => 'No major medical history',
            'blood_group' => 'A+',
            'emergency_contact' => '+880-1711-567891',
        ]);

        return "Test patient created successfully! <a href='/test-db'>Test Database</a>";
    } else {
        return "Test patient already exists! <a href='/test-db'>Test Database</a>";
    }
});

Route::get('/setup-appointments', function () {
    try {
        // Ensure we have a patient
        $patient = \App\Models\Patient::first();
        if (!$patient) {
            // Create a patient first
            $user = \App\Models\User::create([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'patient@test.com',
                'password' => bcrypt('password123'),
                'role' => 'patient',
            ]);

            $patient = \App\Models\Patient::create([
                'users_id' => $user->users_id,
                'phone' => '+880-1711-567890',
                'age' => 35,
                'sex' => 'Male',
                'address' => 'Dhanmondi, Dhaka',
                'medical_history' => 'No major medical history',
                'blood_group' => 'A+',
                'emergency_contact' => '+880-1711-567891',
            ]);
        }

        // Get doctors
        $doctors = \App\Models\Doctor::all();
        if ($doctors->count() < 3) {
            return "Please run <a href='/setup-doctors'>setup doctors</a> first!";
        }

        // Create sample appointments
        $appointments = [
            [
                'doctor_id' => $doctors[0]->doctor_id,
                'patient_id' => $patient->patient_id,
                'appointment_date' => '2025-09-08',
                'appointment_time' => '10:00:00',
                'appointment_status' => 'confirmed',
            ],
            [
                'doctor_id' => $doctors[1]->doctor_id,
                'patient_id' => $patient->patient_id,
                'appointment_date' => '2025-09-10',
                'appointment_time' => '14:00:00',
                'appointment_status' => 'pending',
            ],
            [
                'doctor_id' => $doctors[2]->doctor_id,
                'patient_id' => $patient->patient_id,
                'appointment_date' => '2025-09-05',
                'appointment_time' => '09:00:00',
                'appointment_status' => 'completed',
            ],
        ];

        $created = 0;
        foreach ($appointments as $appointmentData) {
            $existing = \App\Models\Appointment::where([
                ['doctor_id', $appointmentData['doctor_id']],
                ['patient_id', $appointmentData['patient_id']],
                ['appointment_date', $appointmentData['appointment_date']],
                ['appointment_time', $appointmentData['appointment_time']]
            ])->first();

            if (!$existing) {
                \App\Models\Appointment::create($appointmentData);
                $created++;
            }
        }

        return "Setup complete! Created {$created} appointments. <a href='/my-appointments'>View My Appointments</a> | <a href='/test-db'>Test Database</a>";
    } catch (Exception $e) {
        return "Setup failed: " . $e->getMessage();
    }
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


Route::get('/login', function(){
    return view('login.userlogin');
})->name('login');

Route::post('login', LoginController::class)->name('login.attempt');

// ...existing code...
Route::get('/signup', function(){
    return view('login.signup');
})->name('signup');

Route::post('/signup', [App\Http\Controllers\SignupController::class, 'store'])->name('signup.attempt');
// ...existing code...

Route::get('/userdashboard', function(){
    return view('user.userdashboard');
})->name('userdashboard');

Route::get('/admindashboard', function(){
    return view('admin.admindashboard');
})->name('admindashboard');

Route::get('/doctordashboard', function(){
    return view('doctor.doctordashboard');
})->name('doctordashboard');



