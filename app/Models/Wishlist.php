<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'wish_name', 'target_amount' , 'description' , 'icon' , 'initial_target_amount' , 'color'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
