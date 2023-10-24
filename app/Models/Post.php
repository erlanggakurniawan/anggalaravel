<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use HasFactory;
    use Sluggable;

    // digunakan untuk mempersingkat pembuatan database di terminal
    //CONTOH DIBAWAH DIGUNAKAN UNTUK PHP ARTISAN TINKER 

    // Post::create([
    //     'title'=>'Judul Ke Empat',
    //     'excerpt'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia dolorem veritatis possimus sed, velit illum doloribus veniam fuga dicta architecto.',
    //     'body'=>'<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt doloribus, reprehenderit blanditiis magni exercitationem minima animi, asperiores vitae delectus maxime quo! Nobis, veritatis. Aliquam optio qui quae corrupti ipsam aperiam cupiditate, aspernatur fuga voluptate impedit veniam commodi deserunt inventore dolor facere et! Impedit assumenda rem saepe.</p><p>Itaque reprehenderit, officia quisquam laborum iusto nisi, incidunt distinctio voluptate consequatur cupiditate mollitia in possimus quis aliquid velit optio et suscipit voluptatem assumenda nulla maxime molestias adipisci. Ad sapiente officia distinctio dolore, error ipsa iusto atque obcaecati neque eos sequi, nobis suscipit adipisci repellat eius in quam? Voluptates eum optio cupiditate?</p><p>Odio pariatur rem saepe similique facilis porro laudantium ut ad, dolorem, nemo laboriosam labore dignissimos? Veritatis illum accusamus possimus dolor quae, animi eius earum aliquid saepe soluta dolore sed quidem magnam, officiis magni expedita qui minima quos. A asperiores amet nulla porro suscipit reiciendis quas dolorem facere voluptatibus soluta assumenda, vero magnam cupiditate.</p>'
    // ])

    // fillable berguna hanya untuk yang boleh di isi
    // -- protected $fillable = ['title', 'excerpt', 'body', 'slug'];
    // guarded berguna hanya untuk yg ga boleh di isi
    protected $guarded = ['id'];
    protected $with = ['category', 'author'];
    
    // Local Scope
    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                 $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
             });
         });

        //  CALLBACK

         $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('category', function($query) use ($category){
                $query->where('slug', $category);
            });
         });

        //  ERRO FUNCTION

         $query->when($filters['author'] ?? false, fn($query, $author) => 
            $query->whereHas('author', fn($query) => 
                    $query->where('username', $author)
            )
        );

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // tidak ada foreign key untuk author_id, sehingga tambahkan 'user_id' di return
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
