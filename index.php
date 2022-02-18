<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <link rel="icon" href="http://openweathermap.org/img/wn/10d@2x.png"/>
    <link
      rel="stylesheet"
      href="//fonts.googleapis.com/css?family=Just+Another+Hand"
    />
    <title>Weather App</title>
    <!-- Styles -->

    <style>
      body {
        background-image: url("background.jpg");
        background-size: cover;
        background-position: fixed;
        background-repeat: no-repeat;
      }
      </style>
  </head>

  <body>

  


    </div>
  <div id="bg">
  <img src="images/background.jpeg" alt="">
  
  <h1 class="title">Weather Forecast</h1>;

  <div class="box">
    <form method="post" action="index.php" class="form">
    How is the weather in: 
    <input type="text" name="cityName">
    <input type="submit" value="Search" name="submit"> <!-- assign a name for the button -->
    </form>;
  </div>;
    

    <?php
    // Define the variable cityName from html so it can be used in php
    $city = $_POST ["cityName"];
    $api_url = "https://api.openweathermap.org/data/2.5/forecast?q=$city&units=metric&appid=39e27000b7ad4a2041f17253292f9766";

    
    
    // result after clicking the button
    if(isset($_POST['submit'])) {
        // Read JSON file and fetch the current weather data in the cities
        $json_data = file_get_contents($api_url);
        //echo $json_data;
        // Decodes a JSON string into PHP array (parse)
        $city_data = json_decode($json_data);
        $city_list = count($city_data->list);

        echo '<div class="city_title">';
        // shows the city and the country
        echo '<h1>', $city_data->city->name, ' (', $city_data->city->country, ')</h1>';
        echo '</div>';

        echo '<div class="container">';
        // for loop to get the forecast 5 times
        for ($i = 0 ; $i < $city_list; $i++) {
            $city_time = explode(" ", $city_data->list[$i]->dt_txt) ;
            if ($city_time[1] == '15:00:00') {
            

                echo '<div class="item">';
                // shows the date
                echo '<h1>', $city_data->list[$i]->dt_txt , '</h1>';
                $iconName= $city_data->list[$i]->weather[0]->icon;
                // use that to construct a url which points to the icon
                $iconLink= "http://openweathermap.org/img/w/" . $iconName . ".png";
                // write it to your html 
                echo "<img src=$iconLink>";

                // general information about the weather
                echo '<h2>Temperature</h2>';
                echo '<p><strong>Current:</strong> ', $city_data->list[$i]->main->temp, '&deg; C</p>';
                echo '<p><strong>Minimum:</strong> ', $city_data->list[$i]->main->temp_min, '&deg; C</p>';
                echo '<p><strong>Maximum:</strong> ', $city_data->list[$i]->main->temp_max, '&deg; C</p>';

                // something about the air
                echo '<h2>Air</h2>';
                echo '<p><strong>Humidity:</strong> ', $city_data->list[$i]->main->humidity, '%</p>';
                echo '<p><strong>Pressure:</strong> ', $city_data->list[$i]->main->pressure, ' hPa</p>';

                // some info about the wind
                echo '<h2>Wind</h2>';
                echo '<p><strong>Speed:</strong> ', $city_data->list[$i]->wind->speed, ' m/s</p>';
                echo '<p><strong>Orientation:</strong> ', $city_data->list[$i]->wind->deg, '&deg;</p>';

                // how is the weather according to the API (an array)
                echo '<h2>The weather</h2>';
                echo '<p><strong>Description:</strong> ', $city_data->list[$i]->weather[0]->description, '</p>';
              echo '</div>';             
        }
    }
    echo '</div>';
    }
    ?>

    <div class="credits__container">
      <p class="credits__text">@SAMEER</p>
    </div>

  </body>
</html>