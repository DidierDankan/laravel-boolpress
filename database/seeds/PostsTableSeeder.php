<?php

use Illuminate\Database\Seeder;
use Illuminate\support\Str;
use Faker\Generator as Faker;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        for ($i = 0; $i < 5; $i++) {
            
                //crea stanza
                $new_post = new Post();
    
                //popula la stanza
                $new_post->title = $faker->title;
                $new_post->slug = STR::slug($new_post->title, '-' );
                $new_post->content = $faker->realText(200, 2);
    
                //save db
                $new_post->save();
            
        };
    }
}
