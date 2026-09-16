<?php

namespace Database\Factories;

use App\Models\Berat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Berat>
 */
class BeratFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Berat::class;
    public function definition()
    {
        return [
            'berat' => fake()->randomFloat(2, 40, 60)
        ];
    }
}
