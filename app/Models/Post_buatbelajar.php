<?php

namespace App\Models;


class Post
{
   private static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "author" => "Putra Afriansyah",
            "slug" => "judul-post-pertama",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit recusandae debitis explicabo nesciunt blanditiis possimus hic distinctio vel nulla voluptate eligendi, odit porro repellendus consequatur reprehenderit ipsam. Harum expedita itaque quam veritatis, vitae non quos aliquam alias ex vel, placeat fugit odio? Velit sapiente nostrum necessitatibus sint saepe alias magni debitis ullam quia mollitia quis assumenda aliquid eius dolor fugit doloremque nesciunt iusto inventore consectetur id quos, laudantium dicta. Distinctio eaque architecto totam nam eum molestias tempora officia dolorem impedit?"
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Putri nandasyah",
            "body" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae, repudiandae id molestiae velit deserunt nostrum. Beatae exercitationem neque repudiandae aperiam illo voluptatum officiis atque quisquam mollitia accusamus iste nostrum eum dolores iure, fugit adipisci, quae recusandae alias similique. Eius, dolorum ipsa eos laudantium totam soluta, repudiandae, hic itaque eaque facere facilis omnis quibusdam quod ullam illo velit? Dolore corrupti ut suscipit voluptate omnis ipsam accusantium laudantium esse magni. Maxime quidem, dolorem voluptatum officiis rem dolor, consequuntur nobis aperiam fugiat molestias tempore quia ipsa mollitia saepe natus ad culpa cumque excepturi, esse quisquam facilis. Architecto odio quis fugiat quam suscipit id!"
        ]
        ];

        public static function all()
        {
            return collect(self::$blog_posts);
        }

        public static function find($slug)
        {
            $post2 = static::all();
           
            // Mengambil slug yang berada di $slug dari web.php
            return $post2->firstWhere('slug', $slug);

        }

}
