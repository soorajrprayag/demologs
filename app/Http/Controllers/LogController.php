<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;
use Carbon\Carbon;


class LogController extends Controller
{

    public function index(){
        dd("here");
    }
   
    public function about(){

        return view('general.about');
        
    }
    public function contact(){

        return view('general.contact');
    }

    public function logData(){

       
        $logs = Logs::paginate(10);
 

        return view('general.log', compact('logs')); 
    }

    function timeCalculation($time)
    {
        
        

        // Convert milliseconds to readable time (H:i:s)
        $milliseconds = $millisecondsDiff;
        $seconds = floor($milliseconds / 1000);
        $minutes = floor($seconds / 60);
        $hours = floor($minutes / 60);

        $seconds = $seconds % 60;
        $minutes = $minutes % 60;

        $time = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        echo $time; // Output example: 00:01:30

    }
}
