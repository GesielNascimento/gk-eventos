<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',         // 👈🏽 campo adicionado
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'banner_path',
    ];

    /**
     * Um evento pertence a um usuário.
     * Isso indica que o evento foi criado por um usuário específico.
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
     * Relacionamento: Um evento pode ter várias inscrições.
     */
    public function registrations()
    {
        return $this->hasMany(\App\Models\Registration::class);
    }


    /**
     * Um evento pode ter várias inscrições (participants).
     * Isso será usado futuramente para gerenciar quem está inscrito em qual evento.
     */
    //public function participants()
    //{
      //  return $this->hasMany(Participant::class);
    //}
}
