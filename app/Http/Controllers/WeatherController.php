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
            $data[] = [
                'time'=>$posts['daily']['time'][$i],
                'weathercode'=>$posts['daily']['weathercode'][$i],
                'temperature_2m_max'=>$posts['daily']['temperature_2m_max'][$i],
                'temperature_2m_min'=>$posts['daily']['temperature_2m_min'][$i],
            ];
        }
        
        return view('index', ['data' => $data]);
    }
}
