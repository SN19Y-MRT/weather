<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;
use GuzzleHttp\Client;

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
        $posts = json_decode($weather, true);
        $data = [];
        
        for($i = 0; $i <= 6; $i++) {
            $weathercode = $posts['daily']['weathercode'][$i];
            $data[] = [
                'time'=>$posts['daily']['time'][$i],
                'weathername'=>$this->weathername($weathercode),
                'temperature_2m_max'=>$posts['daily']['temperature_2m_max'][$i],
                'temperature_2m_min'=>$posts['daily']['temperature_2m_min'][$i],
            ];
        }
        
        
        return view('index', ['data' => $data]);
    }
    
    public function weathername($weathercode)
    {
            if($weathercode == 0){
                return '快晴';
            }
            if($weathercode == 1){
                return '晴れ';
            }
            if($weathercode == 2){
                return '一部雲';
            }
            if($weathercode == 3){
                return '曇り';
            }
            if($weathercode <= 49){
                return '霧';
            }
            if($weathercode <= 59){
                return '霧雨';
            }
            if($weathercode <= 69){
                return '雨';
            }
            if($weathercode <= 79){
                return '雪';
            }
            if($weathercode <= 84){
                return 'にわか雨';
            }
            if($weathercode <= 94){
                return '雪・雹';
            }
            if($weathercode <= 99){
                return '雷雨';    
            }
    }
}
