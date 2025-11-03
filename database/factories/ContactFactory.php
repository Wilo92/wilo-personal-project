<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact; 


class ContactFactory extends Factory
{
    
    protected $model = Contact::class;

    
     
    public function definition(): array
    {
        return [
            
            'name' => $this->faker->firstName() . ' ' . $this->faker->lastName(), 
            
            
            'phone' => $this->faker->numerify('##########'), 
            
           
            'email' => $this->faker->unique()->safeEmail(), 

            'birthday' => $this->faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),

            'photo' => null,
        ];
    }
}