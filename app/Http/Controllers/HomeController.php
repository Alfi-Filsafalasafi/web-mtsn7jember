<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Teacher;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $latestArticles = Article::published()
            ->latest('published_at')
            ->limit(6)
            ->get();

        $announcements = Article::published()
            ->category('pengumuman')
            ->latest('published_at')
            ->limit(3)
            ->get();

        $totalTeachers = Teacher::where('status', 'aktif')->count();

        return view('home', compact('latestArticles', 'announcements', 'totalTeachers'));
    }
}
