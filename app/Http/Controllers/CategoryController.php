<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Exibe todos os eventos associados a uma categoria pelo slug.
     */
    public function showBySlug($slug)
    {
        // Busca a categoria pelo slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Carrega os eventos da categoria (com paginação, se desejar)
        $events = $category->events()->latest()->paginate(6);

        return view('categories.events', compact('category', 'events'));
    }
}
