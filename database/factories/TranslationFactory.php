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
        $i = 0;
        return [
            'title_id' => rand(1, 2),
            'lang_id'  => rand(1, 2),
            'note'     => null,
            'content'  => $this->faker->text,
        ];
    }
}
//'title'   => [
//    'en' => $this->faker->sentence($nbWords = 7, $variableNbWords = true),
//    'it' => $this->faker->sentence($nbWords = 7, $variableNbWords = true),
//],
