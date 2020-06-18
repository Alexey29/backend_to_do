<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_statuses')->insert([
            [
                'id' => 1,
                'status' => 'DONE',
            ],
            [
                'id' => 2,
                'status' => 'IN PROGRESS',
            ],
            [
                'id' => 3,
                'status' => 'TO DO',
            ]
        ]);
    }
}
