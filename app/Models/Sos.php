<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sos extends Model
{
    use HasFactory;

    protected $table = 'sos';

    protected $fillable = [
        'user_id','message','province','lat','lng'
    ];
}
