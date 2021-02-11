<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    // Relacion de muchos a uno
    public function user() {
        return $this->belongsTo('App\Models\Personal\User', 'user_id');
    }
}
