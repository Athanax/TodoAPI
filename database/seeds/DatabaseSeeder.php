<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 15)->create();
        factory(Task::class, 60)->create() ;
    }
}
