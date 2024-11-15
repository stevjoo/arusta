<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraphicDesign extends Model
{
    use HasFactory;

    protected $table = 'graphic_design';
    protected $fillable = ['title', 'image_path'];
}
