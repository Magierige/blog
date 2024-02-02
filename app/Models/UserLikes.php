<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLikes extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'blog_id',
        'reaction_id',
        'like'
    ];
}
