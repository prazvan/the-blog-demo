<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

/**
 * Class StatusesSeeder
 */
class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'name'        => 'published',
            'description' => 'Published Posts',
        ]);

        Status::create([
            'name'        => 'unpublished',
            'description' => 'UnPublished Posts',
        ]);
    }
}
