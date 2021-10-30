<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 *
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'contact' => $this->generateUniqueContact(),
            'created_by' => 1
        ];
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function generateUniqueContact()
    {
        do {
            $contact = random_int(100000000, 999999999);
        } while (Contact::where('contact', $contact)->first());

        return $contact;
    }
}
