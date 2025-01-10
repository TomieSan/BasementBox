<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'name',
      'publisher_id',
      'description',
      'excerpt',
      'tags',
      'price',
      'logo',
      'gamePic1',
      'gamePic2',
      'gamePic3',
      'gamePic4'
    ];

    public function publisher(): BelongsTo
    {
      return $this->belongsTo(User::class, 'publisher_id');
    }

    public function reviews()
    {
      return $this->hasMany(Review::class);
    }
}
