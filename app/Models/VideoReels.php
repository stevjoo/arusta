<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoReels extends Model
{
    use HasFactory;

    protected $table = 'video_reels';
    protected $fillable = ['title', 'video_path'];
}
