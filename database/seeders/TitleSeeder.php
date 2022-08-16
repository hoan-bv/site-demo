<?php

namespace Database\Seeders;

use App\Models\Title;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class TitleSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Title::factory()->count(20)->create();
    }
}
