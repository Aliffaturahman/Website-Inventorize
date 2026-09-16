<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tinta>
 */
class TintaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_warna' => fake()->numberBetween(1, 9),
            'id_volume' => fake()->numberBetween(1, 9),
            'jumlah_tinta' => fake()->numberBetween(1, 100)
        ];
    }
}
