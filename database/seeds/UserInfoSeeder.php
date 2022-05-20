<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\UserInfo;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Richiamo in un oggetto tutti gli attraverso la classe User
        $users = User::all();

        // Utilizzando il faker in italiano genero per ciascun utente i valori da inserire nella tabella user_infos
        $faker = \Faker\Factory::create('it_IT');
        foreach ($users as $user) {
            UserInfo::create([
                'user_id'   => $user->id, // Questa è la Foreign Key che lega la tabella user_infos alla tabella Users
                'avatar'    => 'https://picsum.photos/id/' . $faker->numberBetween(0, 999) . '/150/150',
                'city'      => $faker->state(), // Nella localizzazione in italiano per generare il nome di una città bisogna usare "state"
                'birthday'  => $faker->date('Y-m-d', '2003-12-31')
            ]);
        }
    }
}
