<?php
session_start();

require_once './classes/weather_api.php';

if (isset($_POST['submit-weather'])) {
  if (!empty($_POST['city-weather'])) {

    $weather = new OpenWeather('805abb5ed51e54f0cd939c5d84f3b472');
    $forecast = $weather->getForecast($_POST['city-weather']);

    if (!empty($forecast)) {

      $city = $_POST['city-weather'];

      $tempWeather = htmlentities($forecast['main']['temp']);

      $descriptionWeather = htmlentities($forecast['weather'][0]['description']);
    }
  }
}

$meteo = 'meteo';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/imaginary.css">
  <title>Imaginary Weather</title>
</head>

<body>


  <header id="weather-header">
    <h1 id="weather-title">La météo</h1>
  </header>


  <form action="Imaginary_weather.php" method="post" id="form-weather">
    <input type="text" name="city-weather" id="input-city-weather">
    <input type="submit" name="submit-weather" id="submit-weather">
  </form>

  <?php
  if (isset($_POST['submit-weather'])) {
    if (isset($tempWeather) and isset($descriptionWeather)) {
  ?>

      <section id="weather">
        <?= $city ?>
        <article>
          <?= $descriptionWeather; ?>
        </article>
        <article>
          <?= $tempWeather . '°C'; ?>
        </article>
      </section>

      <?php
      if (round($tempWeather) < 20) {
      ?>
        <img src="../image/froid.jpeg" alt="Image d'un homme qui a froid" id="image-froid">

      <?php
      } else if (round($tempWeather) > 20) {
      ?>
        <img src="../image/chaud.png" alt="Image d'un glaçon" id="image-glaçon">
      <?php
      }
      ?>
    <?php
    } else {
    ?>
      <section id="weather">
        <?= 'Mince, cette ville n\'existe pas'; ?>
      </section>
  <?php
    }
  }
  ?>
  <footer>
    <?php include('imaginary_footer.php'); ?>
  </footer>
</body>

</html>