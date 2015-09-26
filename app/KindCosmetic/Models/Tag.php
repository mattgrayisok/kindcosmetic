<?php
/**
 * User: Slice
 * Date: 26/09/15
 * Time: 23:07
 */

namespace App\KindCosmetic\Models;


use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model implements SluggableInterface
{

    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    protected $guarded = [];

    public function posts(){
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

}