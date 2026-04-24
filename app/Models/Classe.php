<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = ['nom'];

    public function apprenants()
    {
        return $this->hasMany(User::class, 'classe_id');
    }
}
