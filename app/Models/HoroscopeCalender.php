<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoroscopeCalender extends Model
{
    use HasFactory;
    protected $fillable = ['zodiac_id', 'month', 'year', 'is_sign_generated', 'average', 'total_score'];

    public function parentZodiac(){
        return $this->belongsTo(Zodiac::class, 'zodiac_id');
    }

    public function calenderScore(){
        return $this->hasMany(HoroscopeScore::class);
    }
}
