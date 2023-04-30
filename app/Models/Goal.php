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
        'value',
        'deadline',
        'initial_value',
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
