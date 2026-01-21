<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineMap extends Model
{
    use HasFactory;

    protected $table = 'offline_maps';

    protected $fillable = [
        'user_id',
        'province',
        'downloaded_at',
    ];
}
