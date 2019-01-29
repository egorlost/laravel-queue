<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public $table = 'members';

    protected $fillable = [
        'full_name', 'address', 'city', 'state', 'zipcode', 'is_union', 'member_number', 'email', 'phone'
    ];

    protected $casts = [
        'create_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
