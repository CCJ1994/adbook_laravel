<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'email',
        'phone',
        'fax',
        'addr',
        'type',
        'customer',
        'ein',
        'udn',
        'memo',
        'class',
        'status',
        'modify_by',
    ];
}
