<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'tag', 'email'];

         /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'tag' => 'array',
    ];
}
