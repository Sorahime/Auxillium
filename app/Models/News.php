<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'disaster_type',
        'status',
        'image_path',
    ];

    /**
     * Get the user who created this news article
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
