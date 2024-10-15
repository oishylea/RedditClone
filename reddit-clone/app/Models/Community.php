<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable; // Make sure to import the Sluggable trait

class Community extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'slug'
    ];

    public function sluggable(): array // Corrected function spelling
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}