<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tags = ['Front-end', 'Back-end', 'UI', 'Laravel', 'Design'];

        foreach($tags as $tag) {

            //crea stanza
            $new_tag = new Tag();

            //populare la stanza
            $new_tag->name = $tag;
            $new_tag->slug = Str::slug($new_tag->name, '-');

            //salva stanza
            $new_tag->save();

        }
    }
}
