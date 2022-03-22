<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plush extends Model
{
    use HasFactory;

    protected $table = 'plushes';

    protected $fillable = ['name'];

    protected $visible = ['name'];
}
