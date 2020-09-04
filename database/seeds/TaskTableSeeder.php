<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $userIds = factory(App\User::class, 4)->create()->pluck('id')->toArray();
        $projectIds = factory(App\Project::class, 8)->create()->pluck('id')->toArray();
        $name [] = $faker->sentence(5);
        $taskName []= $faker->sentence(25);

        $task = factory(App\Task::class, 25)->make()->each(function($task) use ($userIds, $projectIds, $name, $taskName) {
            $task->user_id = Arr::random($userIds);
            $task->project_id = Arr::random($projectIds);
            $task->name = Arr::random($name);
            $task->task = Arr::random($taskName);
            // $post->save();
        })->toArray();

        App\Task::insert($task);
    }
}
