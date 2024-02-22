<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    protected $fillable = [
        'user_id', 'action', 'ip', 'table_name', 'table_id'
    ];

}
