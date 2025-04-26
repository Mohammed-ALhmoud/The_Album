<?php

namespace Database\Seeders;
use App\Models\Tag;
use App\Models\Photo;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::factory(3)->create();

        Photo::factory(20)->hasAttached($tags)->create(new Sequence([
            'featured' => false,
            'schedule' => 'New'
        ], [
            'featured' => true,
            'schedule' => 'Old'
        ]));
    }
}
