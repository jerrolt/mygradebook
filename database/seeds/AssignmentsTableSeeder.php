<?php

use Illuminate\Database\Seeder;
use App\Assignment;

class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 10;
        factory(Assignment::class, $count)->create();
    }
}
