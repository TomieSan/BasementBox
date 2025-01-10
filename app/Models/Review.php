<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'game_id',
      'rating',
      'title',
      'body'
    ];

    public function game(): BelongsTo
    {
      return $this->belongsTo(Game::class, 'game_id');
    }

    public function author(): BelongsTo
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
