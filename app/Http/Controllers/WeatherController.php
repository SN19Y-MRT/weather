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
        

        $url = "https://api.open-meteo.com/v1/forecast?latitude=34.686320&longitude=135.520022&daily=weathercode,temperature_2m_max,temperature_2m_min&timezone=Asia%2FTokyo";
        $method = "GET";

        //接続
        $client = new Client();

        $response = $client->request($method, $url);

        $weather = $response->getBody();
        $posts = json_decode($weather, true);
        return view('weather.index', ['posts' => $posts]);
    }

}
