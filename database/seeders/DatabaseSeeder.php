<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Game;
use App\Models\User;
use App\Models\Review;
use App\Models\CartItems;
use App\Models\PurchaseDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
          'username' => 'admin',
          'password' => Hash::make('Administrator101!'),
          'level' => 2
        ]);
        User::factory(20)->create();
        Game::factory(40)->create();
        Review::factory(100)->create();

        foreach(Game::all() as $game)
        {
          $rating = $game->reviews()->avg('rating');
          $game->update(['rating'=>$rating ?? 0]);
          $game->save();
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
