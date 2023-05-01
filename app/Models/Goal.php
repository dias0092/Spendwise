<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'target_amount',
        'deadline',
        'initial_target_amount',
        'icon',
        'color',
        'description',
        'status',
        'progress'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
