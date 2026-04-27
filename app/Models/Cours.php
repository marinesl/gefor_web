<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cours extends Model
{
    use HasFactory;

    protected $fillable = [
        'matiere',
        'date',
        'heure_debut',
        'heure_fin',
        'salle',
        'valide',
        'date_validation',
        'user_id'
    ];

    // Un cours appartient à un user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
