<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Recherche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    
    <form action="" method="post">
        <h1>Formulaire de Recherche</h1>
        <label for="recherche">Rechercher une ville :</label>
        <input type="text" id="recherche" name="city" placeholder="Entrez votre recherche" required>
        <button type="submit">Rechercher</button>
    </form>

    <div class="result">
        <?php
       
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $apiKey = '6d99db61417a619ebf91ef6cfbdf0cc6';
           $city = htmlspecialchars($_POST['city']);
           $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";
       
           $response = @file_get_contents($apiUrl);
           if ($response === FALSE) {
               $error = error_get_last();
               echo "<p class='error'>Error fetching data: {$error['message']}</p>";
           } else {
               $weatherData = json_decode($response, true);
               if ($weatherData['cod'] == 200) {
                   $temp = $weatherData['main']['temp'];
                 
               } else {
                   echo "<p class='error'>Endroit introuvable ou erreur de l'api: {$weatherData['message']}</p>";
               }
           }
       }
       ?>
    <div class="resultat">
        <div class="meteo-container">
            <div class="ville"> <?php echo $city;  ?></div>
            <div class="icone">☀️</div>
            <div class="temperature"><?php echo "{$temp}&deg;C.";  ?></div>
            <div class="condition">   <?php echo $city;  ?></div>
            <div class="infos">Humidité : 60% | Vent : 15 km/h</div>
            <div class="temps">Dernière mise à jour : <?php echo date('l jS \of F Y h:i:s A');  ?></div>
        </div>
    </div>
</body>
</html>
