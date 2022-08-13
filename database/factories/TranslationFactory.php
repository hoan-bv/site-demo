<?php

namespace Database\Factories;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Translation::class;

    public function definition() {

        return [
            'title'   => $this->faker->title,
            'lang_id' => rand(1,2),
            'content' => $this->faker->text,
        ];
    }
}
//'title'   => [
//    'en' => $this->faker->sentence($nbWords = 7, $variableNbWords = true),
//    'it' => $this->faker->sentence($nbWords = 7, $variableNbWords = true),
//],
