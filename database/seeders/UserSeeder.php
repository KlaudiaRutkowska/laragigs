<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(Listing::factory()
                //->hasTags(random_int(1, 4))
                ->afterCreating(function (Listing $listing) {
                    $tags = Tag::factory()->count(random_int(1, 4))->create();
                    $listing->tags()->saveMany($tags);
                })
                ->count(5))
            ->count(3)
            ->create();
    }
}
