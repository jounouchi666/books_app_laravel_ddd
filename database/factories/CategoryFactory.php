<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(2, true),
        ];
    }

    /**
     * 作成日、更新日を過去の日時とする
     */
    public function old(): static
    {
        return $this->state(function () {
            $createdAt = fake()->dateTimeBetween('-1 year', '-1 day');
            $updatedAt = fake()->dateTimeBetween($createdAt, 'now');

            return [
                'created_at' => $createdAt,
                'updated_at' => $updatedAt
            ];
        });
    }

    /**
     * 論理削除済みを生成
     */
    public function deleted(): static
    {
        return $this->state(function () {
            $createdAt = fake()->dateTimeBetween('-1 year', '-6 months');
            $updatedAt = fake()->dateTimeBetween($createdAt, '-1 month');
            $deletedAt = fake()->dateTimeBetween($updatedAt, 'now');

            return [
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
                'deleted_at' => $deletedAt
            ];
        });
    }
}
