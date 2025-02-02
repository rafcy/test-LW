<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'leads';

    protected $casts = [
        'consent' => 'boolean'
    ];

    protected $fillable = ['full_name', 'email', 'consent'];
}
