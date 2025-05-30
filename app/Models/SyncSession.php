<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyncSession extends Model
{
    protected $fillable = ['session_id', 'video_url', 'timestamp'];
}
