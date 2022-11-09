<?php

namespace Database\Seeders;

use App\Models\ClassOffer;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ClassOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = Teacher::take(10)->get();
        foreach ($teachers as $teacher) {
            ClassOffer::create([
                'teacher_id' => $teacher->id,
                'subject_id' => Subject::inRandomOrder()->first()->id,
                'school' => 'スパルタ高校',
                'money' => '1000円',
                'area' => '八幡平市',
            ]);
        }
    }
}
