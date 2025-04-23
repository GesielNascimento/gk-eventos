<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Cria um usuário administrador
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gkeventos.com',
            'password' => Hash::make('senha123'),
        ]);

        // ✅ Cria categorias padrão
        $categories = [
            'Educação' => 'educacao',
            'Saúde' => 'saude',
            'Tecnologia' => 'tecnologia',
            'Religião' => 'religiao',
            'Meio Ambiente' => 'meio-ambiente',
            'Outros' => 'outros',
        ];

        foreach ($categories as $name => $slug) {
            Category::create([
                'name' => $name,
                'slug' => $slug,
            ]);
        }

        // ✅ Cria um evento de teste público
        Event::create([
            'user_id'     => $user->id,
            'title'       => 'Evento Teste Público',
            'description' => 'Evento criado automaticamente no ambiente PostgreSQL.',
            'event_date'  => now()->addDays(5),
            'event_time'  => '19:00',
            'location'    => 'Praça da Bíblia',
            'banner_path' => 'banners/default.jpg',
            'category_id' => 3, // Tecnologia
            'is_public'   => true,
        ]);
    }
}
