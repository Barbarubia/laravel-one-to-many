<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Travels'
            ],
            [
                'name' => 'Photography'
            ],
            [
                'name' => 'Technology'
            ],
            [
                'name' => 'Games'
            ],
            [
                'name' => 'Movies & Series'
            ],
            [
                'name' => 'Music'
            ],
            [
                'name' => 'Lifestyle'
            ],
            [
                'name' => 'Health & Fitness'
            ],
            [
                'name' => 'Fashion'
            ],
            [
                'name' => 'Food'
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'category'  => $category['name'],
                'slug'      => Str::of($category['name'])->slug('-')
            ]);
        }
    }
}
