<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'game_id',
      'quantity'
    ];

    public function game()
    {
      return $this->hasOne(Game::class, 'id', 'game_id');
    }
}
