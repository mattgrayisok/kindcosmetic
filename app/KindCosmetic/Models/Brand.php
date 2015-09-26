<?php
/**
 * User: Slice
 * Date: 26/09/15
 * Time: 23:05
 */

namespace App\KindCosmetic\Models;


use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model implements SluggableInterface
{

    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    protected $guarded = [];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function image(){
        return $this->belongsTo(Image::class);
    }

}