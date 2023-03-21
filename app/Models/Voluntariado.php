<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voluntariado extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'ciudad',
        'empresa_id',
        'image'
    ];

    public function empresa() {
        return $this->belongsTo(Empresa::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_voluntariado')->withTimestamps();
    }

}
