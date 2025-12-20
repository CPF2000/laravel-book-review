<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->sentence(3),
            'author'=>fake()->name,
            'created_at'=>fake()->dateTimeBetween('-2 years'),//创建日期为2年前到现在的时间间隔
            'updated_at'=>fake()->dateTimeBetween('created_at','now')//更新日期为创建日期到现在的时间间隔


        ];
    }
}
