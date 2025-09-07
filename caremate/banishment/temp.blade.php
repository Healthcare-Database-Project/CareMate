    <!-- Appointments -->
    <!-- <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Upcoming Appointments</h2>
        <ul>
            <!-- @foreach($user->appointments as $appointment)
                <li class="border-b py-2">
                    Dr. {{ $appointment->doctor->name }} on {{ $appointment->appointment_date }}
                    <button class="bg-blue-500 text-white rounded px-2 py-1 ml-4">Cancel</button>
                </li>
            @endforeach -->
        <!-- </ul>
    </div> --> 

    <!-- Health Info -->
    <div class="bg-white rounded shadow p-4 mb-6">
        <h2 class="text-xl font-semibold mb-2">Recent Health Info</h2>
        @foreach($user->patient->healthInfos as $info)
            <div class="mb-2">
                <p>Date: {{ $info->date_of_recording }} - Blood Sugar: {{ $info->bloodSugarLevel->blood_sugar_level }} - BP: {{ $info->bloodPressure->blood_pressure }}</p>
            </div>
        @endforeach
    </div>