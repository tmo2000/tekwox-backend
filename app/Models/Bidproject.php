<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidproject extends Model
{
    use HasFactory;

    protected $fillable = [
        'bidid',
        'biddocument',
        'currency',
        'amount',
        'supportingdocument'
    ];
}
