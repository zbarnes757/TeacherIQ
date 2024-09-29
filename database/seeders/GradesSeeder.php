<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            'Pre-Kindergarten',
            'Kindergarten',
            '1st Grade',
            '2nd Grade',
            '3rd Grade',
            '4th Grade',
            '5th Grade',
            '6th Grade',
            '7th Grade',
            '8th Grade',
            '9th Grade',
            '10th Grade',
            '11th Grade',
            '12th Grade',
        ];

        foreach ($grades as $grade) {
            Grade::create([
                'name' => $grade,
            ]);
        }
    }
}
