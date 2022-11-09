<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create(['name' => '国語']);
        Subject::create(['name' => '算数']);
        Subject::create(['name' => '理科']);
        Subject::create(['name' => '社会']);
        Subject::create(['name' => '英語']);
        Subject::create(['name' => '数学']);
        Subject::create(['name' => 'その他']);
    }
}
