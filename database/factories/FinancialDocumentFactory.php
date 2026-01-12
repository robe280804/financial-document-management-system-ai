<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Enums\FlowType;
use App\Enums\DocumentStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinancialDocument>
 */
class FinancialDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'flow_type' => $this->faker->randomElement(FlowType::cases()),
            'counterparty' => $this->faker->company(),
            'amount' => $this->faker->randomFloat(2, 1, 10000),
            'currency' => $this->faker->randomElement(['EUR', 'USD', 'GBP']),
            'issue_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'due_date' => $this->faker->optional()->dateTimeBetween('now', '+9 months'),
            'status' => $this->faker->randomElement(DocumentStatus::cases()),
            'user_id' => User::first()?->id ?? User::factory(),
        ];
    }
}
