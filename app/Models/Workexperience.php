<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workexperience extends Model
{
    use HasFactory;

    protected $fillable = [
        //'name',
            'email',
            'companyname',
            'jobtitle',
            'jobdescription',
            'activework',
            'startdate',
            'enddate',
    ];

}
