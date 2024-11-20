<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Local;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Local>
 */
class LocalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Local::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(Local::LOCALS), // Gera um local fake e coloca dentro da lista de locais no Model
        ];
    }
}
