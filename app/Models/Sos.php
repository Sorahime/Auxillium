<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sos extends Model
{
    use HasFactory;

    protected $table = 'sos';

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'description',
        'location',
        'latitude',
        'longitude',
        'status',
        'admin_response',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
