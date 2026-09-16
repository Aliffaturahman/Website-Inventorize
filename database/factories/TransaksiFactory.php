<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_stok_kertas' => fake()->numberBetween(1, 9),
            'jumlah_kertas' => fake()->numberBetween(1, 100),
            'id_stok_kain' => fake()->numberBetween(1, 9),
            'jumlah_kain' => fake()->numberBetween(1, 100),
            'tgl' => fake()->dateTime(),
            'keterangan' => fake()->paragraph()
        ];
    }
}
