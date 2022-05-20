<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creo un utente admin con valori fissi
        User::create([
            'name'      => 'Admin',
            'email'     => 'admin@boolpress.it',
            'password'  => Hash::make('12345678')
        ]);

        // Creo altri 9 utenti generati con il faker localizzato in italiano
        $faker = \Faker\Factory::create('it_IT');
        for ($i=0; $i < 9; $i++) {
            User::create([
                'name'      => $faker->name(),
                'email'     => $faker->email(),
                'password'  => Hash::make('qwerasdf')
            ]);
        }
    }
}
