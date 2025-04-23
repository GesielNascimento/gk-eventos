<?php

namespace App\Models;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path', // ✅ adicionado
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relacionamento: Um usuário pode estar inscrito em muitos eventos.
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Relacionamento: Um usuário pode criar vários eventos.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * ✅ Acessor para obter a URL da foto de perfil ou gerar avatar
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? asset('storage/' . $this->profile_photo_path)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random';
    }
}
