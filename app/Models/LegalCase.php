<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalCase extends Model
{
    use HasFactory;

    protected $table = 'cases';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'content',
        'image',
        'category',
        'status',
        'case_date'
    ];

    protected $casts = [
        'case_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // URL dostu slug oluşturma
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = \Str::slug($value);
    }
}
