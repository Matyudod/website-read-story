<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'story';
    protected $fillable = ['story_name', 'story_background', 'story_description', 'story_slug', 'status'];
}