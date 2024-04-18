<?php

namespace Database\Factories;

use App\Models\Dog;
use Illuminate\Database\Eloquent\Factories\Factory;

class DogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $breeds       = config('constants.breeds');
        $allergies    = config('constants.allergies');        
        $randomNumber = $this->faker->numberBetween(1, count($allergies));

        return [
            'name'      => $this->faker->firstName(),
            'breed'     => $this->faker->randomElement($breeds),
            'age'       => $this->faker->numberBetween(1, 360), // 360 = 30 years
            'allergies' => $this->faker->optional(0.5, [])->randomElements($allergies, $randomNumber),
        ];
    }
}
