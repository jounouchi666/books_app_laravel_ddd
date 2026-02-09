<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'title',
        'user_id',
        'category_id',
    ];

    protected $attributes = [
        'category_id' => null,
    ];

    public function posts() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function users() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
