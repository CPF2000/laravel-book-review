<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id'=>null,
            'review'=>fake()->paragraph,
            'rating'=>fake()->numberBetween(1,5),
            'created_at'=>fake()->dateTimeBetween('-2 years'),//创建日期为2年前到现在的时间间隔
            'updated_at'=>fake()->dateTimeBetween('created_at','now')//更新日期为创建日期到现在的时间间隔
        ];
    }
    //评价差劲的书籍,在seeder中使用
    public function bad(){
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(1,2),
            ];
        });
    }
    //评价一般的书籍,在seeder中使用
    public function average(){
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(3,4),
            ];
        });
    }
    //评价高的书籍,在seeder中使用
    public function good(){
        return $this->state(function (array $attributes) {
            return [
                'rating' => fake()->numberBetween(4,5),
            ];
        });
    }
    
}
