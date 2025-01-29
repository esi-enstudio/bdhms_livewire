<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static search($search)
 * @method static insert()
 * @method static whereNotNull( string $string )
 * @method static create( array $attributes )
 * @method static firstWhere()
 * @method static where()
 * @method static pluck(string $string)
 * @method static count()
 * @method static whereIn(string $string, array $selectedRecords)
 * @method static findOrFail($id)
 * @property mixed $zm
 * @property mixed $manager
 * @property mixed $supervisor
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $disabled_at
 * @property mixed $id
 * @property mixed $document
 * @property mixed $user
 */
class Retailer extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];
    protected $with = ['rso','house','user'];

    protected array $searchable = [
        'code',
        'itop_number',
        'name',
        'user.name',
        'user.phone',
        'house.code',
        'house.name',
    ];

    /**
     * Relationship with User model
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with User model
     *
     * @return BelongsTo
     */
    public function rso(): BelongsTo
    {
        return $this->belongsTo(Rso::class);
    }

    /**
     * Relationship with User model
     *
     * @return BelongsTo
     */
    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }
}
