<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Comment::create([
        //     'author_id' => 1,
        //     'project_id' => 1,
        //     'content' => 'Wah Gokil Projectnya'
        // ]);
        Comment::create([
            'author_id' => 1,
            'project_id' => 2,
            'content' => 'Wah Mantap nih projectnya'
        ]);
        Comment::create([
            'author_id' => 1,
            'project_id' => 3,
            'content' => 'Pake Bahasa pemrograman apa kak?'
        ]);
    }
}
