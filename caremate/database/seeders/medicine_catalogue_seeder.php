<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicineCatalogue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class medicine_catalogue_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MedicineCatalogue::create(
            [
        'common_name' => 'Fexo 120',
        'generic_name' => 'Fexofenadine Hydrochloride',
        'med_type' => 'Tablet',
        'dosage' => '120mg',
        'price' => '9.00'
        ]
    );

        MedicineCatalogue::create([
        'common_name' => 'Alatrol 10',
        'generic_name' => 'Cetirizine Hydrochloride',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '3.01'
    ]);
    }
}
