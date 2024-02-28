<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $string1, $id)
 */
class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'name',
        'icon',
        'owner_id',
        'description'
    ];
    protected $with = ['owner'];

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(User::class, 'roomAble');
    }
}
