<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
        'thumbnail',
        'category',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    // Relasi ke user (penulis)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope: hanya artikel yang sudah published
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at');
    }

    // Scope: filter by kategori
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
