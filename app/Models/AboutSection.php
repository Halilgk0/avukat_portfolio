<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'content',
        'image',
        'lawyer_name',
        'lawyer_title',
        'experience',
        'education',
        'certificates',
        'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean'
    ];
}
