<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'projectreferencenumber',  
        'projecttitle',
        'projectdetails',
        'location',
        'opentolocalbusinesses',
        'openinternationally',       
        'preferredbiddingcurrency1',
        'makecurrencymandatory',
        'preferredbiddingcurrency2',
        'limitbidamount',
        'bidamount',
        'startdate',
        'starttime',
        'enddate',
        'endtime'
     ];
}
