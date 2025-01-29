<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static search( $search )
 * @method static create( array $attributes )
 * @method static insert(array[] $array)
 */
class Product extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected array $searchable = [
        'name',
        'code',
        'lifting_price',
        'face_value',
    ];
}
