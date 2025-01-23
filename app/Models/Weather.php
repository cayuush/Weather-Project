<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    //fillable fields
    use HasFactory;
    // Specify the correct table name
    protected $table = 'weather_data';
    // Disable timestamps
    public $timestamps = false;
    protected $fillable = ['city_name', 'temperature', 'weather_description', 'retrieved_at'];
}
