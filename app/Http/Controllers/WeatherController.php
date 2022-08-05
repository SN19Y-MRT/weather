<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;
use GuzzleHttp\Client;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class WeatherController extends Controller
{
    /**
    * Post⼀覧を表⽰する
    *
    * @param Post Postモデル
    * @return array Postモデルリスト
    */
    public function index()
    {
        //{ time: "2022-08-02", code: 80.0, temperature_max: 30, temperature_min: 25 },
        //{ time: "2022-08-03", code: 80.0, temperature_max: 30, temperature_min: 25 },
        
        
        
        $city = Weather::where('id',1)->first();
        
        ($city->latitude);
        ($city->longitude);
        
        $latitude = $city->latitude;
        $longitude = $city->longitude;
        
        //$url = "https://api.open-meteo.com/v1/forecast?latitude=34.686320&longitude=135.520022&daily=weathercode,temperature_2m_max,temperature_2m_min&timezone=Asia%2FTokyo";
        $url = "https://api.open-meteo.com/v1/forecast?latitude=$latitude&longitude=$longitude&daily=weathercode,temperature_2m_max,temperature_2m_min&timezone=Asia%2FTokyo";
        $method = "GET";
        
        //接続
        $client = new Client();

        $response = $client->request($method, $url);

        $weather = $response->getBody();
        $weatherdata = json_decode($weather, true);
        
        $units = [
            'temperature_2m_max_'=>$weatherdata['daily_units']['temperature_2m_max'],
            'temperature_2m_min_'=>$weatherdata['daily_units']['temperature_2m_min'],
        ];
        $weathers = [];
        for($i = 0; $i <= 6; $i++) {
            $weathercode = $weatherdata['daily']['weathercode'][$i];
            $time = $weatherdata['daily']['time'][$i];
            $weathers[] = [
                'time'=>$time,
                'week'=>self::week[date("w", strtotime($time))],
                'weathername'=>$this->weathername($weathercode),
                'temperature_2m_max'=>$weatherdata['daily']['temperature_2m_max'][$i],
                'temperature_2m_min'=>$weatherdata['daily']['temperature_2m_min'][$i],
            ];
        }
        $cityname = $city->name;
        
        return view('index', compact('weathers','cityname','units'));
    }
    
    public function weathername($weathercode)
    {
            if($weathercode == 0){
                return '☀';
            }
            if($weathercode == 1){
                return '☀';
            }
            if($weathercode == 2){
                return '⛅';
            }
            if($weathercode == 3){
                return '☁';
            }
            if($weathercode <= 49){
                return '🌫';
            }
            if($weathercode <= 59){
                return '🌫☔';
            }
            if($weathercode <= 69){
                return '☔';
            }
            if($weathercode <= 79){
                return '☃';
            }
            if($weathercode <= 84){
                return '🌧';
            }
            if($weathercode <= 94){
                return '☃';
            }
            if($weathercode <= 99){
                return '⛈';    
            }
    }
    
    const week = array( "(日)", "(月)", "(火)", "(水)", "(木)", "(金)", "(土)" );
    
    
}
