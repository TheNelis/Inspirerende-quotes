<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Name;
use App\Models\Quote;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users aanmaken
        $users = User::factory(15)->create();

        // Boards aanmaken
        $boards = Board::factory(5)->create([
            'user_id' => fn() => $users->random()->id
        ]);

        // Many-to-many relaties maken
        foreach ($boards as $board) {
            // Ken random aantal users (1-2) toe aan elk board
            $board->users()->attach(
                $users->random(rand(1, 2))->pluck('id')->toArray()
            );
        }

        // Names aanmaken
        $names = Name::factory(15)->create([
            'board_id' => fn() => $boards->random()->id
        ]);

        // Quotes aanmaken
        Quote::factory(100)->create([
            'name_id' => fn() => $names->random()->id,
            'user_id' => fn() => $users->random()->id,
            'board_id' => fn() => $boards->random()->id
        ]);
    }
}
