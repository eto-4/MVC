<?php
// views/home/404.php
http_response_code(404);
?>

<div class="text-center my-5">
    <h1 class="display-3">404</h1>
    <h2>Pàgina no trobada</h2>
    <p class="text-muted">Ho sentim, la pàgina que estàs buscant no existeix.</p>
    <a href="<?= BASE_PATH ?>/" class="btn btn-primary mt-3">Tornar a l'inici</a>
</div>
