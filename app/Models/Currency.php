<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = ['currency_code', 'currency_name'];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
