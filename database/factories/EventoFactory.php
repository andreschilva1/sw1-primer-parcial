<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'nombre' => $this->faker->sentence(4),
                'descripcion' => $this->faker->text(),
                'direccion' => $this->faker->address(),
                'fecha' => now(),
                'hora' => now(),
                'ubicacion' => null,
                'photo_path' => null,
                'organizadores_id' => 1,
        ];
    }
}
