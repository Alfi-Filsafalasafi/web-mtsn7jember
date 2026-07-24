<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    use HasFactory;

    protected $table = 'surveis';

    protected $fillable = [
        'name',
        'description',
        'link',
        'sort_order',
    ];
}
