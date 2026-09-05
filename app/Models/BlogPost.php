<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'featured',
        'published_at'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'published_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Geçici olarak devre dışı bırakıldı - ID ile erişim için
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    // URL dostu slug oluşturma
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = \Str::slug($value);
    }
}
