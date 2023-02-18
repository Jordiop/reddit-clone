<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Community;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $jordi = User::factory()->create([
            'name' => 'Jordi',
            'email' => 'jordi@gmail.com',
        ]);

        $fran = User::factory()->create([
            'name' => 'Fran',
            'email' => 'fran@gmail.com',
        ]);

        // Creamos 5 comunidades, 2 de Jordi y 3 de Fran y 5 posts, 2 de Jordi y 3 de Fran y 5 comentarios, 2 de Jordi y 3 de Fran

        for ($i = 1; $i < 6; $i++) {
            if ($i % 2 == 0) {
                $user = $fran;
            } else {
                $user = $jordi;
            }

            // Creamos las comunidades
            $community = Community::factory()->create([
                'name' => 'Comunidades prueba' . $i,
            ]);

            // Creamos los posts
            $post = Post::factory(rand(1,5))->create([
                'title' => 'Test Post ' . $i,
                'body' => 'Test Post Body ' . $i,
                'user_id' => $user->id,
                'community_id' => $community->id,
            ]);

            // Creamos los comentarios, 1, 2 o 3
            foreach ($post as $p) {
                Comment::factory(rand(1, 3))->create([
                    'body' => 'Test Comment ' . $i,
                    'user_id' => $user->id,
                    'post_id' => $p->id,
                ]);
            }

            $user->communities()->attach($community);
        }
    }
}
