Overview
Weather-Project is a Laravel-based weather application designed to fetch live weather updates from the OpenWeatherMap API. The data is stored in a MySQL database to ensure fast access and offline availability. With a frontend built using jQuery and HTML, Weather-Project offers a smooth and user-friendly experience for accessing weather information.
This project has been developed as part of an academic exercise to showcase the integration of APIs, database management, and frontend design.
______________
Features
•	Real-Time Weather Data: Fetch accurate weather information for any city.
•	Data Storage: Previously fetched weather data is saved for offline access.
•	Easy-to-Use Interface: A responsive and intuitive design built with jQuery and HTML.
•	Location Search: Simply input a city name to access its current weather information.
•	Backend Power: Leveraging Laravel and MySQL for stability and performance.
______________
Installation
Prerequisites
Before setting up the project, ensure you have the following installed:
•	PHP 
•	Composer
•	MySQL 

Steps
1.	Clone the Repository:
bash
git clone https://github.com/your-username/weather-project.git  
cd weather-project  
2.	Install Dependencies:
Use Composer to install Laravel dependencies:
bash
composer install  
3.	Set Up Environment:
Create a .env file in the root directory and configure your database and API key:
env
DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=weather_project  
DB_USERNAME=your-db-username  
DB_PASSWORD=your-db-password  

OPENWEATHERMAP_API_KEY=your-api-key  
4.	Run Migrations:
Set up the database by running the migrations:
bash
php artisan migrate  
5.	Start the Server:
Launch the Laravel development server:
bash
php artisan serve  
Visit http://localhost:8000 in your browser to access the app.


______________
Usage
1.	Open the application in your browser.
2.	Enter a city name in the search bar.
3.	Click the "Get Weather" button to fetch live weather data.
4.	Previously searched data is stored in the database for quicker access in the future.
______________
Technologies
Here’s what powers Weather-Project:
•	Backend: Laravel
•	Database: MySQL
•	API Integration: OpenWeatherMap API
