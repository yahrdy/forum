<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(ChannelsTableSeeder::class);
         $this->call(DiscusionsTableSeeder::class);
         $this->call(RepliesTableSeeder::class);
    }
}
