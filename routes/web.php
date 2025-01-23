<?php
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'weather'); // Display the frontend user interface
 Route::post('/api', [WeatherController::class, 'getCityWeatherData']);//fetch data from local database
Route::post('/weather', [WeatherController::class, 'fetchWeather']); // calling API endpoint
