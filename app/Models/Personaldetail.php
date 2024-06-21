<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personaldetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'bio',
        'nationality',
        'country',
        'cvpath',
        'businessname',
        'website',
        'industry',
        'no_of_employee',
    ];
}
