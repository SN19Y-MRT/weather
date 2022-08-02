<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;

class WeatherController extends Controller
{
    /**
    * Post⼀覧を表⽰する
    *
    * @param Post Postモデル
    * @return array Postモデルリスト
    */
    public function index(Weather $weather)
    {
        return $weather->get();
    }

}
