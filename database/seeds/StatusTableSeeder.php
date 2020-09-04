<?php

use Illuminate\Database\Seeder;
use App\TaskStatus;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'status' => 'New',
            ],
            [
                'status' => 'In progress',
            ],
            [
                'status' => 'Done',
            ]
        ];

        TaskStatus::insert($data);
    }
}
