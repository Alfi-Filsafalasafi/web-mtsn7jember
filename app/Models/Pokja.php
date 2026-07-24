<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokja extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'description',
        'gdrive_url',
        'sort_order',
    ];
}
