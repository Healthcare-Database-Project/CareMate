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

    MedicineCatalogue::create([
        'common_name' => 'Napa',
        'generic_name' => 'Paracetamol',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '1.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Seclo',
        'generic_name' => 'Omeprazole',
        'med_type' => 'Capsule',
        'dosage' => '20mg',
        'price' => '3.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Losectil',
        'generic_name' => 'Esomeprazole',
        'med_type' => 'Tablet',
        'dosage' => '20mg',
        'price' => '8.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Monas',
        'generic_name' => 'Montelukast',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '7.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Amodis',
        'generic_name' => 'Amodiaquine Hydrochloride',
        'med_type' => 'Tablet',
        'dosage' => '200mg',
        'price' => '2.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Ace',
        'generic_name' => 'Paracetamol',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '1.10'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Maxpro',
        'generic_name' => 'Esomeprazole',
        'med_type' => 'Tablet',
        'dosage' => '20mg',
        'price' => '7.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Histac',
        'generic_name' => 'Ranitidine',
        'med_type' => 'Tablet',
        'dosage' => '150mg',
        'price' => '2.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Amlodipin',
        'generic_name' => 'Amlodipine',
        'med_type' => 'Tablet',
        'dosage' => '5mg',
        'price' => '2.20'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Neotack',
        'generic_name' => 'Ticagrelor',
        'med_type' => 'Tablet',
        'dosage' => '90mg',
        'price' => '25.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Ciprocin',
        'generic_name' => 'Ciprofloxacin',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '6.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Azith',
        'generic_name' => 'Azithromycin',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '35.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Clavulin',
        'generic_name' => 'Amoxicillin + Clavulanic Acid',
        'med_type' => 'Tablet',
        'dosage' => '625mg',
        'price' => '18.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Motigut',
        'generic_name' => 'Domperidone',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '2.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Pantra',
        'generic_name' => 'Pantoprazole',
        'med_type' => 'Tablet',
        'dosage' => '20mg',
        'price' => '6.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Lorat',
        'generic_name' => 'Loratadine',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '2.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Metformin',
        'generic_name' => 'Metformin Hydrochloride',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '2.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Bisocor',
        'generic_name' => 'Bisoprolol Fumarate',
        'med_type' => 'Tablet',
        'dosage' => '5mg',
        'price' => '4.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Ator',
        'generic_name' => 'Atorvastatin',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '7.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Glucophage',
        'generic_name' => 'Metformin Hydrochloride',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '2.80'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Norvasc',
        'generic_name' => 'Amlodipine',
        'med_type' => 'Tablet',
        'dosage' => '5mg',
        'price' => '3.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Cilosta',
        'generic_name' => 'Cilostazol',
        'med_type' => 'Tablet',
        'dosage' => '50mg',
        'price' => '12.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Rabeprazole',
        'generic_name' => 'Rabeprazole Sodium',
        'med_type' => 'Tablet',
        'dosage' => '20mg',
        'price' => '9.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Montene',
        'generic_name' => 'Montelukast',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '6.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Seretide',
        'generic_name' => 'Salmeterol + Fluticasone',
        'med_type' => 'Inhaler',
        'dosage' => '25mcg + 250mcg',
        'price' => '450.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Augmentin',
        'generic_name' => 'Amoxicillin + Clavulanic Acid',
        'med_type' => 'Tablet',
        'dosage' => '625mg',
        'price' => '20.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Algin',
        'generic_name' => 'Sodium Alginate',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '5.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Telnex',
        'generic_name' => 'Telmisartan',
        'med_type' => 'Tablet',
        'dosage' => '40mg',
        'price' => '8.00'
    ]);
}

    }

