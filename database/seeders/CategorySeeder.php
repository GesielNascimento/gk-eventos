<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Executa o seeder.
     */
    public function run(): void
    {
        $categorias = [
            'Educação',
            'Saúde',
            'Tecnologia',
            'Religião',
            'Meio Ambiente',
            'Outros'
        ];

        foreach ($categorias as $nome) {
            Category::create(['name' => $nome]);
        }
    }
}
