<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <header class="container">
       <h1>Hotels</h1> 
    </header>

    <div class="container rounded-top bg-light">
        <form action="" method="GET">
            <div class="my-3">
                <input type="checkbox" name="parking" id="parking">
                <label for="parking">Parcheggio interno</label>
            </div>

            <select class="form-select" name="vote">
                <option selected>Voto minimo</option>
                <option value="1">⭐</option>
                <option value="2">⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="5">⭐⭐⭐⭐⭐</option>
            </select>

            <button type="submit" class="btn btn-sm btn-dark my-3">Cerca</button>
        </form>

        <?php //var_dump($_GET) ?>
    </div>
    
    <div class="container mt-4">
        <div class="row row-cols-5 fw-bold border-bottom pb-2 bg-secondary rounded-top">
            <div class="col">Nome</div>
            <div class="col">Descrizione</div>
            <div class="col">Parcheggio</div>
            <div class="col">Voto</div>
            <div class="col">Distanza</div>
        </div>
<?php
     $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

    # isset() è una funzione che torna true se il valore è settato o false se è null
    # se $_GET['vote'] è valorizzato assegna il valore parsato in int alla variabile, altrimenti assegna 0
    $parkingFilter = isset($_GET['parking']);
    $voteFilter = isset($_GET['vote']) ? (int) $_GET['vote'] : 0;

    $filteredHotels = [];

    foreach($hotels as $hotel) {
        // se voglio il parcheggio ma l'hotel non ce l'ha salto
        if ($parkingFilter && !$hotel['parking']) {
            continue;
        }

        // se il voto è troppo basso salto
        if ($hotel['vote'] < $voteFilter) {
            continue;
        }

        $filteredHotels[] = $hotel;
    };

    //var_dump($filteredHotels);

    foreach($filteredHotels as $hotel) {
        echo "<div class='row row-cols-5 border-bottom'>";
        foreach($hotel as $key => $value) {

            if($key === 'parking') {
                $value = $value ? "Si" : "No";
            };

            if($key === 'vote') {
                $stars = '';
                for($i = 0; $i < $value; $i++) {
                    $stars .= '⭐';
                };
                $value = $stars;
            };

            if($key === 'distance_to_center') {
                $value .= ' Km';
            };

            echo "<div class='col bg-light'>$value</div>";

        };
        echo "</div>";
    };
    ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>