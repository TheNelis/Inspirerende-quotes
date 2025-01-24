<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'image', 'pinned', 'user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
