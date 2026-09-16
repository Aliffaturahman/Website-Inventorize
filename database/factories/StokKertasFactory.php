<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StokKertas>
 */
class StokKertasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_berat' => fake()->numberBetween(1, 9),
            'id_kertas' => fake()->numberBetween(1, 9),
            'lebar' => fake()->numberBetween(50, 200),
            'panjang' => fake()->numberBetween(50, 200),
            'jumlah_kertas' => fake()->numberBetween(1, 100)
        ];
    }
}
