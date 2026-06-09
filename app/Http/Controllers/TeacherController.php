<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::where('status', 'aktif')
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('position', 'like', '%' . $request->q . '%')
                    ->orWhere('subject', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('filter')) {
            if ($request->filter === 'guru') {
                $query->whereNotNull('subject');
            } elseif ($request->filter === 'staf') {
                $query->whereNull('subject');
            }
        }

        $teachers = $query->paginate(20)->withQueryString();

        return view('teachers', compact('teachers'));
    }
}
