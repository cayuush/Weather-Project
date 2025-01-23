<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Weather;

class WeatherController extends Controller
{
    //Read weather from open weather map api and store into the local database
    public function fetchWeather(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'city' => 'required|string|max:250',
        ]);
        $city = $validated['city'];

        // Check if data is already cached (e.g., within the last 10 minutes)
        $cachedWeather = Weather::where('city_name', $city)
            ->where('retrieved_at', '>=', now()->subMinutes(10))
            ->first();

        if ($cachedWeather) {
            return response()->json($cachedWeather);
        }

        // Fetch from OpenWeatherMap API
        $apiKey = env('WEATHER_DATA_API_KEY');// read api key from  env file
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
        ]);
         //handle error from OpenWeatherMap API
        if ($response->failed()) {
            return response()->json(['error' => 'City not found'], 404);
        }
        //convert the response received from the OpenWeatherMap API into a PHP array or object format
        $data = $response->json();
        //inser in to table
        $weather = Weather::create([
            'city_name' => $data['name'],
            'temperature' => $data['main']['temp'],
            'weather_description' => $data['weather'][0]['description'],
            'retrieved_at' => now(),
        ]);
        // return json response
        return response()->json($weather);
    }
//Read wheather data from local database by a given city
    public function getCityWeatherData(Request $request)
    {
        // Validate the city name from the request
        $validated = $request->validate([
            'city' => 'nullable|string|max:250',
        ]);

        $city = $validated['city'] ?? null;

        // Fetch data based on the provided city or retrieve all if no city is specified
        $weatherData = $city 
            ? Weather::where('city_name', $city)->get() 
            : Weather::all();

        return response()->json($weatherData);
    }

}


