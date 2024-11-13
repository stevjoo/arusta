<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BehindTheLense extends Model
{
    use HasFactory;

    protected $table = 'behind_the_lenses';
    protected $fillable = ['title', 'image_path'];
}
