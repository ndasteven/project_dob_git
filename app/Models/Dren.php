<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dren extends Model
{
    use HasFactory;
    public $primaryKey = 'code_dren';
    public $incrementing = false;
    protected $fillable = [
        'code_dren','nom_dren'
    ];
}
