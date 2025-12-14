<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
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
