<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;
    protected $table   = 'review';
    public $primaryKey = 'reviewID';
    public $timestamps = true;

    protected $fillable = [

    ];
}
