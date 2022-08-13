<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Language::class;

    public function definition() {
        return [
            'locale' => $this->faker->country,
            'code'   => $this->faker->countryCode,
        ];
    }
}
