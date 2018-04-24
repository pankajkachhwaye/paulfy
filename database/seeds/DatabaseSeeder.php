<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('categories')->insert([
           [ 'name' => 'News',
            'description' => "This is News Categories",
            'created_at' =>Carbon::now()
             ],
            [ 'name' => 'Tech',
                'description' => "This is Tech Categories",
                'created_at' =>Carbon::now()
            ],
            [ 'name' => 'Business',
                'description' => "This is Business Categories",
                'created_at' =>Carbon::now()
            ],
            [ 'name' => 'Sports',
                'description' => "This is Sports Categories",
                'created_at' =>Carbon::now()
            ],
            [ 'name' => 'Entertainment',
                'description' => "This is Entertainment Categories ",
                'created_at' =>Carbon::now()
            ]

           ]);
    }
}
