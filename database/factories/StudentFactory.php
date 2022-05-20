<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nrcTypes = ['C', 'AC', 'NC', 'V', 'M', 'N'];
        return [
            'birth_date' => $this->faker->date(),
            'nrc' => $this->faker->numberBetween(1, 14) . "/" . strtoupper($this->faker->lexify('????')) . "(" . $nrcTypes[array_rand($nrcTypes)] . ")" . $this->faker->randomNumber(6),
        ];
    }
}
