<?php

namespace Database\Factories\Wise;

use App\Models\Wise\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Participant>
 */
class ParticipantFactory extends Factory
{

    protected $model = Participant::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstname(),
            'middle_name' => fake()->firstname(),
            'last_name' => fake()->lastname(),
            'suffix' => 'Jr',
            'position' => 'CEO',
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
