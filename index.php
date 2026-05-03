<?php

$hotels = [
  [
    'name' => 'Hotel Belvedere',
    'description' => 'Hotel Belvedere Descrizione',
    'parking' => true,
    'vote' => 4,
    'distance_to_center' => 10.4,
  ],
  [
    'name' => 'Hotel Futuro',
    'description' => 'Hotel Futuro Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 2,
  ],
  [
    'name' => 'Hotel Rivamare',
    'description' => 'Hotel Rivamare Descrizione',
    'parking' => false,
    'vote' => 1,
    'distance_to_center' => 1,
  ],
  [
    'name' => 'Hotel Bellavista',
    'description' => 'Hotel Bellavista Descrizione',
    'parking' => false,
    'vote' => 5,
    'distance_to_center' => 5.5,
  ],
  [
    'name' => 'Hotel Milano',
    'description' => 'Hotel Milano Descrizione',
    'parking' => true,
    'vote' => 2,
    'distance_to_center' => 50,
  ],
]; ?>

<?php
$filtered_hotels = [];
$count = 0;

$parking_filter = $_GET['parking'] ?? '';
$vote_filter = $_GET['vote'] ?? '';

foreach ($hotels as $hotel) {
  if ($parking_filter !== '') {
    $has_parking = $parking_filter === '1';

    if ($hotel['parking'] !== $has_parking) {
      continue;
    }
  }

  if ($vote_filter !== '') {
    if ($hotel['vote'] < intval($vote_filter)) {
      continue;
    }
  }

  $filtered_hotels[] = $hotel;
  $count++;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Master Boolean in Web Development [152] - Specializzazione PHP/Laravel - Assegnazione L02
"
    />
    <meta name="author" content="Giovanni Mazzi" />
    <title>EX - PHP Hotel</title>

    <!-- Icona Progetto -->
    <!-- <link rel="icon" href="./assets/img/..." /> -->
    <link
      rel="icon"
      href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏨</text></svg>"
    />

    <!-- Bootstrap Icons -->
    <!-- <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    /> -->

    <!-- Google Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://..."
      rel="stylesheet"
    /> -->

    <!-- Bootstrap CSS -->
     <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />

    <!-- Reset Style -->
    <!-- <link rel="stylesheet" href="css/reset_style.css" /> -->

    <!-- Stylesheet -->
    <!-- <link rel="stylesheet" href="css/style.css" /> -->

  </head>
  <body>
    <div class="container mt-5">
      <h1 class="mb-4 text-center">HOTELS</h1>

      <form method="GET" class="row g-3 mb-4">
      <div class="col-12 col-md-6">
        <label for="parking" class="form-label">Parcheggio</label>
        <select name="parking" id="parking" class="form-select">
          <option value="">Tutti</option>
          <option value="1" <?php echo $parking_filter === '1' ? 'selected' : ''; ?>>
            Con parcheggio
          </option>
          <option value="0" <?php echo $parking_filter === '0' ? 'selected' : ''; ?>>
            Senza parcheggio
          </option>
        </select>
      </div>

      <div class="col-12 col-md-6">
        <label for="vote" class="form-label">Voto minimo</label>
        <select name="vote" id="vote" class="form-select">
          <option value="">Tutti</option>
          <?php for ($i = 1; $i <= 5; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php echo $vote_filter == $i ? 'selected' : ''; ?>>
              <?php echo $i; ?> stelle o più
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary" type="submit">Filtra</button>
        <a href="index.php" class="btn btn-secondary">Reset</a>
      </div>
    </form>
      <?php if ($count > 0) { ?>
        <table class="table table-striped table-hover table-bordered text-center align-middle table-responsive">
          <thead class="table-success">
            <tr>
              <th scope="col">#</th>
              <?php foreach ($filtered_hotels[0] as $key => $value) {
                $key = strtoupper(str_replace('_', ' ', $key));
                echo "<th scope=\"col\">$key</th>";
              } ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($filtered_hotels as $index => $hotel) {
              echo '<tr>';
              echo "<th scope=\"row\">" . $index + 1 . '</th>';
              foreach ($hotel as $key => $value) {
                if ($key === 'parking') {
                  $value = $value
                    ? '<span class="badge bg-success">Yes</span>'
                    : '<span class="badge bg-danger">No</span>';
                }
                if ($key === 'vote') {
                  $value = str_repeat('⭐', $value);
                }
                echo "<td>$value</td>";
              }
              echo '</tr>';
            } ?>
            </tbody>
        </table>
      <?php } else { ?>
        <p>Non ci sono risultati da visualizzare.</p>
      <?php } ?>

      
    </div>
    <!-- <h1>HOTELS</h1> -->
    <!-- <?php foreach ($hotels as $hotel) {
      foreach ($hotel as $key => $value) {
        echo "$key -> $value <br/>";
      }
      echo '<br/>';
    } ?> -->
  </body>
</html>
