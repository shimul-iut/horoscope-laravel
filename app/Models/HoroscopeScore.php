<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoroscopeScore extends Model
{
    use HasFactory;
    protected $fillable = ['horoscope_calender_id', 'day', 'score', 'mark', 'prophecy'];

    public function parentCalender(){
        return $this->belongsTo(HoroscopeCalender::class, 'horoscope_calender_id');
    }
}
