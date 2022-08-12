<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'content',
        'msg_date',
        'modify_by',
        'status',
    ];
}
