<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'image', 'pinned', 'user_id', 'token'];

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('pinned');
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
