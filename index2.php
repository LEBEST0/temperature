<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        input[type="text"] {
            padding: 10px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1></h1>
        <form method="POST" action="">
            <input type="text" name="city" placeholder="Enter city name" required>
            <button type="submit">Obtenir la temperature</button>
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
                       echo "The temperature in {$city} is {$temp}&deg;C.";
                   } else {
                       echo "<p class='error'>Endroit introuvable ou erreur de l'api: {$weatherData['message']}</p>";
                   }
               }
           }
           ?>
           
            
        </div>
    </div>
</body>
</html>
