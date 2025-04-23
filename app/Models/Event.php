<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'banner_path',
        'category_id', // 👈🏽 novo campo para associação com a categoria
    ];

    /**
     * Um evento pertence a um usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Usuários inscritos no evento.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Um evento pode ter várias inscrições.
     */
    public function registrations()
    {
        return $this->hasMany(\App\Models\Registration::class);
    }

    /**
     * Um evento pertence a uma categoria.
     * Relacionamento para identificar a qual categoria o evento pertence.
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}
