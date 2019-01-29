<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public const STATUS_PENDING = 'Pending';
    public const STATUS_ERROR = 'Error';
    public const STATUS_COMPLETED = 'Completed';

    public $table = 'files';

    protected $fillable = [
        'filename', 'hash', 'treated_members', 'members', 'time_processing', 'status', 'error'
    ];

    protected $casts = [
        'time_processing' => 'datetime',
        'create_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
