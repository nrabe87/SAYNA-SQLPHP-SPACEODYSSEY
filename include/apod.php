<?php
// Clé API de la NASA
$api_key = "DEMO_KEY"; // Remplacez cela par votre vraie clé API

// Emplacement du fichier cache
$cache_file = 'apod_cache.json';

// Vérifier si le cache existe et s'il est encore valide pour la journée
if (file_exists($cache_file) && time() - filemtime($cache_file) < 86400) {
    // Utiliser les données mises en cache
    $apod_data = json_decode(file_get_contents($cache_file));
} else {
    // Appel de l'API de la NASA pour l'Astronomy Picture of the Day (APOD) en utilisant cURL
    $api_url = "https://api.nasa.gov/planetary/apod?api_key=" . urlencode($api_key);

    $ch = curl_init($api_url);
    if ($ch === false) {
        die('Erreur cURL : Impossible d\'initialiser la ressource cURL');
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        die('Erreur cURL : ' . curl_error($ch));
    }

    curl_close($ch);

    // Vérifier si la réponse est valide avant de la décoder
    if ($response) {
        $apod_data = json_decode($response);

        // Enregistrer les données dans le cache
        if ($apod_data) {
            file_put_contents($cache_file, json_encode($apod_data));
        }
    }
}

// Affichage de l'image APOD et sa description
if ($apod_data) {
    echo '<h2>Astronomy Picture of the Day</h2>';
    echo '<h3>' . $apod_data->title . '</h3>';
    echo '<p>' . $apod_data->explanation . '</p>';
    echo '<img src="' . $apod_data->url . '" alt="Astronomy Picture of the Day">';
} else {
    echo 'Impossible de récupérer l\'Astronomy Picture of the Day pour le moment.';
}
?>
