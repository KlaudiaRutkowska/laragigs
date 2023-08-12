<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->count(3)->create();

        Listing::factory()
            // ->has(Tag::factory()->count(random_int(1, 4)))
            ->count(10)
            ->for($user)
            ->afterCreating(function (Listing $listing) {
                $tags = Tag::factory()->count(random_int(1, 4))->create();
                $listing->tags()->saveMany($tags);
            })
            ->create();
    }
}
