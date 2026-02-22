<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected static array $categoryIds;
    protected static array $userIds;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->getCategoryIds();
        $this->getUserIds();

        return [
            'title' => fake()->words(3, true),
            'category_id' => fake()->randomElement([null, ...self::$categoryIds]),
            'user_id' => fake()->randomElement(self::$userIds)
        ];
    }

    /**
     * 読書状況が読書中
     */
    public function reading(): static
    {
        return $this->state(function () {
            return [
                'reading_status' => 'reading'
            ];
        });
    }

    /**
     * 読書状況が読了
     */
    public function completed(): static
    {
        return $this->state(function () {
            return [
                'reading_status' => 'completed'
            ];
        });
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

    /**
     * カテゴリーIDリストをプロパティに追加
     * （取得済みなら何もしない）
     */
    private function getCategoryIds(): void
    {
        if (isset(self::$categoryIds)) return;
        
        self::$categoryIds = Category::query()->pluck('id')->all();
    }

    /**
     * ユーザーIDリストをプロパティに追加
     * （取得済みなら何もしない）
     */
    private function getUserIds(): void
    {
        if (isset(self::$userIds)) return;
        
        self::$userIds = User::query()->pluck('id')->all();
    }
}
