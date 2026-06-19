<?php

namespace Database\Factories;

use App\Models\Player;
use App\Services\Paises;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $paises = Paises::paises();

        return [
            'user' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
            'genero' => $this->faker->randomElement([
                'Masculino',
                'Feminino',
                'Outro'
            ]),
            'pais' => $this->faker->randomElement($paises),
            'foto' => 'photos/vazio.png',
            'nivel' => random_int(1, 70),
            'xp' => random_int(0, 1000),
            'quantidade_vitorias' => random_int(0, 100),
            'quantidade_derrotas' => random_int(0, 100),
            'online' => false
        ];
    }
}
