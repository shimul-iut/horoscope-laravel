<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zodiac extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon', 'magic_number', 'celebrities'];

    public function zodiacCalenders(){
        return $this->hasMany(HoroscopeCalender::class);
    }
}
