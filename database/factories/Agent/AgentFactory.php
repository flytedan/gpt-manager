<?php

namespace Database\Factories\Agent;

use App\Models\Agent\Agent;
use App\Models\Team\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Agent>
 */
class AgentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'team_id'      => Team::factory(),
            'knowledge_id' => null,
            'name'         => fake()->firstName,
            'description'  => fake()->paragraph,
            'model'        => fake()->randomElement(Agent::getAiModelNames()),
            'functions'    => [],
            'temperature'  => 0,
            'prompt'       => fake()->paragraphs(10, true),
        ];
    }
}
