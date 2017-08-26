<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/posts.json");
        $data = json_decode($json);

        foreach($data->posts as $obj) {
            DB::table('posts')->insert(array(
                "user_id" => 1,
                "title"  => $obj->title,
                "abstract"  => $obj->abstract,
                "content"      => $obj->content,
                "url_thumbnail" => $obj->url_thumbnail
            ));
        }
    }
}
