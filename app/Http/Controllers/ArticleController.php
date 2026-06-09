<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('status', 'published')
            ->orderBy('published_at', 'desc');

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->paginate(9)->withQueryString();

        return view('articles', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('articles-show', compact('article'));
    }
}
