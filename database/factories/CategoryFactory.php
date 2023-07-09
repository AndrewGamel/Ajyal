<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
        $name =$this->faker->unique()->department;
                //$this->faker->unique()->words(2,true);
        return [
            'name'=> $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(15),
            'image' =>$this->faker->avatar('foo', '300x300', 'jpg','set'.rand(1,5),'bg'.rand(1,6)),
            //$this->faker->imageUrl(),
        ];
    }
}