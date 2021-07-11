<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
    
    public function colourBrightness($shittyHex, $superHex, $percent)
    {
        if($percent > 6) $hex = $superHex;
        else $hex = $shittyHex;

        $percent = round($percent/10, 1);
        
        if($percent == 0.1) return $shittyHex;

        $hash = '';
        if (stristr($hex, '#')) {
            $hex = str_replace('#', '', $hex);
            $hash = '#';
        }
        /// HEX TO RGB
        $rgb = [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
        for ($i = 0; $i < 3; $i++) {

            if ($percent > 0) {
                // Lighter
                $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
            } else {
                // Darker
                $positivePercent = $percent - ($percent * 2);
                $rgb[$i] = round($rgb[$i] * (1 - $positivePercent)); // round($rgb[$i] * (1-$positivePercent));
            }
            if ($rgb[$i] > 255) {
                $rgb[$i] = 255;
            }
        }
        //// RBG to Hex
        $hex = '';
        for ($i = 0; $i < 3; $i++) {
            $hexDigit = dechex($rgb[$i]);
            if (strlen($hexDigit) == 1) {
                $hexDigit = "0" . $hexDigit;
            }
            $hex .= $hexDigit;
        }
        return $hash . $hex;
    }

    public function fortuneCookie($score){
        
        $reallShittyPhrases = [
        "loose all your money", 
        "have an accident", 
        "experience a heart attack", 
        "get fired from job",
        "catch your partner cheating",
        "get divorced"
        ];

        $shittyPhrases = [
        "fall from the stairs",
        "find your ex with someone else",
        "burn hand during cooking",
        "loose your phone"
        ];
        
        $slightlyBetterPhrases = [
        "have date night with partner",
        "get a pay-raise email",
        "go for a hike in mountains",
        "pass an exam with good grades",
        "become a sober"
        ];
        
        $superExcitingPhrases = [
        "get married",
        "become a parent",
        "win tickets to Hawaii",
        "buy a new house",
        "get promoted"
        ];
        
        if($score < 4) {
            $phrase = "Oops! Today , you can ".$reallShittyPhrases[rand(0, count($reallShittyPhrases) - 1)]. ' and most likely, you can also '.$shittyPhrases[rand(0, count($shittyPhrases) - 1 )];
        }
        else if($score < 6){
            $phrase = "You might ".$shittyPhrases[rand(0, count($shittyPhrases) - 1)]. ' but if you are not careful enoguh, you may '.$reallShittyPhrases[rand(0, count($reallShittyPhrases) - 1)];
        }
        else if($score < 10){
            $phrase = "Great ! chances are high you may ".$slightlyBetterPhrases[rand(0, count($slightlyBetterPhrases) - 1)]. ' but if your are really lucky, you are gonna '.$superExcitingPhrases[rand(0, count($superExcitingPhrases) - 1)]. ' too';
        }
        else $phrase = "Bless Thy Fortune ! this is the day you are gonna ".$superExcitingPhrases[rand(0, count($superExcitingPhrases) - 1)]. ". Congratulations !" ;

        return $phrase;
    }

}
