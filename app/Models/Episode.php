<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episode';
    protected $fillable = ['story_id', 'episode', 'episode_name', 'content', 'slug'];
}