<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model {
    use HasFactory;

    protected $table = 'quotes';

    protected $fillable = ['name_id', 'date', 'quote', 'favourite', 'user_id', 'board_id'];

    public function name()
    {
        return $this->belongsTo(Name::class);
    }

    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}