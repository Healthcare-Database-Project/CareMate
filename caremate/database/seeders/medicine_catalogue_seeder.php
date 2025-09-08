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
        'common_name' => 'Ace 500',
        'generic_name' => 'Paracetamol',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '1.20'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Napa Extra',
        'generic_name' => 'Paracetamol + Caffeine',
        'med_type' => 'Tablet',
        'dosage' => '500mg + 65mg',
        'price' => '2.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Seclo 20',
        'generic_name' => 'Omeprazole',
        'med_type' => 'Capsule',
        'dosage' => '20mg',
        'price' => '3.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Losectil 20',
        'generic_name' => 'Omeprazole',
        'med_type' => 'Capsule',
        'dosage' => '20mg',
        'price' => '3.60'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Maxpro 20',
        'generic_name' => 'Esomeprazole',
        'med_type' => 'Tablet',
        'dosage' => '20mg',
        'price' => '4.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Pantosec 20',
        'generic_name' => 'Pantoprazole',
        'med_type' => 'Tablet',
        'dosage' => '20mg',
        'price' => '4.20'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Seroxat 20',
        'generic_name' => 'Paroxetine',
        'med_type' => 'Tablet',
        'dosage' => '20mg',
        'price' => '12.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Motilium 10',
        'generic_name' => 'Domperidone',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '2.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Amdocal 5',
        'generic_name' => 'Amlodipine',
        'med_type' => 'Tablet',
        'dosage' => '5mg',
        'price' => '3.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Norvasc 5',
        'generic_name' => 'Amlodipine',
        'med_type' => 'Tablet',
        'dosage' => '5mg',
        'price' => '3.20'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Monas 10',
        'generic_name' => 'Montelukast',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '8.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Montene 10',
        'generic_name' => 'Montelukast',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '8.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Ciprocin 500',
        'generic_name' => 'Ciprofloxacin',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '6.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Cipro 500',
        'generic_name' => 'Ciprofloxacin',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '6.20'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Azith 500',
        'generic_name' => 'Azithromycin',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '15.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Azicin 500',
        'generic_name' => 'Azithromycin',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '15.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Clavulin 625',
        'generic_name' => 'Amoxicillin + Clavulanic Acid',
        'med_type' => 'Tablet',
        'dosage' => '500mg + 125mg',
        'price' => '18.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Augmentin 625',
        'generic_name' => 'Amoxicillin + Clavulanic Acid',
        'med_type' => 'Tablet',
        'dosage' => '500mg + 125mg',
        'price' => '18.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Flagyl 400',
        'generic_name' => 'Metronidazole',
        'med_type' => 'Tablet',
        'dosage' => '400mg',
        'price' => '2.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Metronid 400',
        'generic_name' => 'Metronidazole',
        'med_type' => 'Tablet',
        'dosage' => '400mg',
        'price' => '2.10'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Zithrin 500',
        'generic_name' => 'Azithromycin',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '15.20'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Histacin 10',
        'generic_name' => 'Chlorpheniramine Maleate',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '1.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Lorat 10',
        'generic_name' => 'Loratadine',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '2.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Loratadine 10',
        'generic_name' => 'Loratadine',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '2.10'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Ranit 150',
        'generic_name' => 'Ranitidine',
        'med_type' => 'Tablet',
        'dosage' => '150mg',
        'price' => '2.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Ranitidine 150',
        'generic_name' => 'Ranitidine',
        'med_type' => 'Tablet',
        'dosage' => '150mg',
        'price' => '2.60'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Neotack 500',
        'generic_name' => 'Metformin Hydrochloride',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '3.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Metfor 500',
        'generic_name' => 'Metformin Hydrochloride',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '3.10'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Glucophage 500',
        'generic_name' => 'Metformin Hydrochloride',
        'med_type' => 'Tablet',
        'dosage' => '500mg',
        'price' => '3.20'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Glimet 2',
        'generic_name' => 'Glimepiride',
        'med_type' => 'Tablet',
        'dosage' => '2mg',
        'price' => '5.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Glimepiride 2',
        'generic_name' => 'Glimepiride',
        'med_type' => 'Tablet',
        'dosage' => '2mg',
        'price' => '5.10'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Ator 10',
        'generic_name' => 'Atorvastatin',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '7.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Lipitor 10',
        'generic_name' => 'Atorvastatin',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '7.20'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Rosuva 10',
        'generic_name' => 'Rosuvastatin',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '8.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Rosuvastatin 10',
        'generic_name' => 'Rosuvastatin',
        'med_type' => 'Tablet',
        'dosage' => '10mg',
        'price' => '8.20'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Bisoprolol 5',
        'generic_name' => 'Bisoprolol Fumarate',
        'med_type' => 'Tablet',
        'dosage' => '5mg',
        'price' => '4.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Bisoprolol 2.5',
        'generic_name' => 'Bisoprolol Fumarate',
        'med_type' => 'Tablet',
        'dosage' => '2.5mg',
        'price' => '2.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Concor 5',
        'generic_name' => 'Bisoprolol Fumarate',
        'med_type' => 'Tablet',
        'dosage' => '5mg',
        'price' => '4.60'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Concor 2.5',
        'generic_name' => 'Bisoprolol Fumarate',
        'med_type' => 'Tablet',
        'dosage' => '2.5mg',
        'price' => '2.60'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Aspirin 75',
        'generic_name' => 'Aspirin',
        'med_type' => 'Tablet',
        'dosage' => '75mg',
        'price' => '1.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Aspirin 300',
        'generic_name' => 'Aspirin',
        'med_type' => 'Tablet',
        'dosage' => '300mg',
        'price' => '2.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Clopidogrel 75',
        'generic_name' => 'Clopidogrel',
        'med_type' => 'Tablet',
        'dosage' => '75mg',
        'price' => '6.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Plavix 75',
        'generic_name' => 'Clopidogrel',
        'med_type' => 'Tablet',
        'dosage' => '75mg',
        'price' => '6.20'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Losartan 50',
        'generic_name' => 'Losartan Potassium',
        'med_type' => 'Tablet',
        'dosage' => '50mg',
        'price' => '5.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Losar 50',
        'generic_name' => 'Losartan Potassium',
        'med_type' => 'Tablet',
        'dosage' => '50mg',
        'price' => '5.20'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Telmisartan 40',
        'generic_name' => 'Telmisartan',
        'med_type' => 'Tablet',
        'dosage' => '40mg',
        'price' => '6.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Telmisartan 80',
        'generic_name' => 'Telmisartan',
        'med_type' => 'Tablet',
        'dosage' => '80mg',
        'price' => '8.00'
    ]);

    // Capsule medicines added below
    MedicineCatalogue::create([
        'common_name' => 'Amoxil 500',
        'generic_name' => 'Amoxicillin',
        'med_type' => 'Capsule',
        'dosage' => '500mg',
        'price' => '3.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Doxy 100',
        'generic_name' => 'Doxycycline',
        'med_type' => 'Capsule',
        'dosage' => '100mg',
        'price' => '4.50'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Fluclox 500',
        'generic_name' => 'Flucloxacillin',
        'med_type' => 'Capsule',
        'dosage' => '500mg',
        'price' => '3.80'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Omidon 10',
        'generic_name' => 'Domperidone',
        'med_type' => 'Capsule',
        'dosage' => '10mg',
        'price' => '2.80'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Neurobion',
        'generic_name' => 'Vitamin B1 + B6 + B12',
        'med_type' => 'Capsule',
        'dosage' => 'Standard',
        'price' => '5.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Roxithromycin 150',
        'generic_name' => 'Roxithromycin',
        'med_type' => 'Capsule',
        'dosage' => '150mg',
        'price' => '7.00'
    ]);

    MedicineCatalogue::create([
        'common_name' => 'Cephradine 500',
        'generic_name' => 'Cephradine',
        'med_type' => 'Capsule',
        'dosage' => '500mg',
        'price' => '4.00'
    ]);
    }
}
