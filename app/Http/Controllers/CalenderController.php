<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Controllers\UtilController;
use App\Models\HoroscopeCalender;
use App\Models\HoroscopeScore;
use App\Models\Zodiac;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    protected $utils;

    public function __construct(UtilController $utils)
   {
        $this->utils = $utils;
        $this->shittyColor = '#ff0000';
        $this->superColor = '#00ff00';
   }


    public function index($year, $sign)
    {
        $zodiacYear = HoroscopeCalender::where('zodiac_id' , $sign)->where('year', $year)->with('calenderScore')->get();
        $bestMonth = HoroscopeCalender::select('month', 'average')->where('zodiac_id' , $sign)->where('year', $year)->orderBy('average', 'desc')->first();
        $zodiac = Zodiac::find($sign);
        return view('calender', compact('year', 'sign', 'zodiacYear', 'bestMonth', 'zodiac' ));
    }

    public function store(Request $request)
    {
        # To keep the demonstration minimal, Only years from 2021 to 2030 are allowed. Although this app is prepared to take unlimited year values 
        $request->validate([
             'year' => 'required|integer|between:2021,2030',
             'zodiac_id' => 'required|integer|between:1,12',
         ]);
         
         //Generating Horoscopes on the fly. If already exists , then skip !

        if(HoroscopeCalender::where('zodiac_id', $request->zodiac_id)->where('year', $request->year)->count() > 0) return [$request->zodiac_id, $request->year];
        try{
            for($i = 1; $i <= 12 ; $i++){
                
                #Creating the Horoscope calender entry of a given sign and year
                $calender = new HoroscopeCalender();

                $totalScore = 0;
                $calender->zodiac_id = $request->zodiac_id;
                $calender->year = $request->year;
                $calender->month = $i;

                $calender->save();

                $days_in_the_month = cal_days_in_month(CAL_GREGORIAN, $calender->month, $calender->year);

                for($j = 1; $j <= $days_in_the_month ; $j++){
                    
                    $score = new HoroscopeScore();
                    # Creating the Randomized Horoscope Score and Hex value entries for each day of the year entered previously
                    $score->horoscope_calender_id = $calender->id;
                    $score->day = $j;
                    $score->score = rand(1,10);
                    
                    # Two Utility Functions imported from the Util Class for randomized Color codes and Sentences

                    $score->mark = $this->utils->colourBrightness($this->shittyColor, $this->superColor, $score->score );
                    $score->prophecy = $this->utils->fortuneCookie($score->score);
                    $score->save();

                    $totalScore = $totalScore + $score->score; 
                }
                $avgScore = round($totalScore/$days_in_the_month, 1);
                $calender->update(['average' => $avgScore, 'total_score' => $totalScore, 'is_sign_generated' => 1]);
                }
            }
        catch(Exception $e){
            echo json_encode(array(
                 'error' => array(
                    'msg' => $e->getMessage(),
                    'code' => $e->getCode(),
                )
             )
            );
        }
        return [$request->zodiac_id, $request->year]; 
    }
    

    public function allZodiacs(Request $request){

        $request->validate([
            'year' => 'required|integer|between:2021,2030',
            
        ]);
        $zodiac = Zodiac::all();

        //Generating Horoscopes on the fly. If already exists , then skip !
        if(HoroscopeCalender::where('year', $request->year)->count() == 144) return HoroscopeCalender::select('zodiac_id', 'total_score')->where('year', $request->year)->with('parentZodiac')->orderBy('total_score', 'desc')->take(2)->get();
        try{
           foreach($zodiac as $sign){

            #Performing the same task as the 'store' method, just for all the available Zodiac signs for a given year
            $yearlyTotalScorePerZodiac = 0;
            
            if(!HoroscopeCalender::where('year', $request->year)->where('zodiac_id' , $sign->id)->exists()){
                for($i = 1; $i <= 12 ; $i++){
                    $totalScore = 0;

                    $calender = new HoroscopeCalender();
                    $calender->zodiac_id = $sign->id;
                    $calender->year = $request->year;
                    $calender->month = $i;

                    $calender->save();

                    $days_in_the_month = cal_days_in_month(CAL_GREGORIAN, $calender->month, $calender->year);

                    for($j = 1; $j <= $days_in_the_month ; $j++){
                        
                        $score = new HoroscopeScore();

                        $score->horoscope_calender_id = $calender->id;
                        $score->day = $j;
                        $score->score = rand(1,10);
                        $score->mark = $this->utils->colourBrightness($this->shittyColor, $this->superColor, $score->score );
                        $score->prophecy = $this->utils->fortuneCookie($score->score);
                        $score->save();

                        $totalScore = $totalScore + $score->score; 
                    }

                    $avgScore = round($totalScore/$days_in_the_month, 1);
                    $yearlyTotalScorePerZodiac = $yearlyTotalScorePerZodiac + $totalScore;
                    
                    $calender->update(['average' => $avgScore, 'total_score' => $yearlyTotalScorePerZodiac, 'is_sign_generated' => 1]);
                    }
                }
            }
        }
       catch(Exception $e){
           echo json_encode(array(
                'error' => array(
                   'msg' => $e->getMessage(),
                   'code' => $e->getCode(),
               )
            )
           );
       }
    return HoroscopeCalender::select('zodiac_id', 'total_score')->where('year', $request->year)->with('parentZodiac')->orderBy('total_score', 'desc')->take(2)->get();
    }

}
