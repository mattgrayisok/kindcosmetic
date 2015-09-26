<?php
/**
 * User: Slice
 * Date: 26/09/15
 * Time: 23:02
 */

namespace App\KindCosmetic\Models;


use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements SluggableInterface
{

    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    protected $guarded = [];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function image(){
        return $this->belongsTo(Image::class);
    }

}