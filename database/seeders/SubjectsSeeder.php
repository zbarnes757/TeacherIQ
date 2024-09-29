<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            'Mathematics',
            'English Language Arts',
            'Science',
            'Social Studies',
            'Foreign Languages',
            'Physical Education',
            'Art',
            'Music',
            'Technology',
            'Health',
            'Drama',
            'Computer Science',
            'Engineering',
            'Robotics',
            'Environmental Science',
            'Psychology',
            'Sociology',
            'Economics',
            'Philosophy',
            // Add more subjects as needed
        ];

        foreach ($subjects as $subject) {
            Subject::create([
                'name' => $subject,
            ]);
        }
    }
}
