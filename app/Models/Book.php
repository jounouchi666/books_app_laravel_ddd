<?php

namespace App\Models;

use App\Domain\Book\ValueObject\BookReadingStatus;
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
        'reading_status'
    ];

    protected $attributes = [
        'category_id' => null,
        'reading_status' => BookReadingStatus::Unread
    ];

    protected function casts(): array
    {
        return [
            'reading_status' => BookReadingStatus::class
        ];
    }

    public function posts() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function users() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
