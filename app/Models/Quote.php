<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model {
    use HasFactory;

    protected $table = 'quotes';

    protected $fillable = ['name_id', 'date', 'quote', 'favourite'];

    public function name()
    {
        return $this->belongsTo(Name::class);
    }
}