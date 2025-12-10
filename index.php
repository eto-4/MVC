<?php
/**
 * index.php
 * 
 * Punt d'entrada principal de l'aplicació MVC.
 * Gestiona totes les rutes a través del Router, crida als controladors corresponents i fa la conexió a la bbdd.
 */

require_once 'Router.php'; // Incloem la classe Router

<?php
// setup.php - se ejecuta solo la primera vez

$host = 'localhost';
$dbName = 'mi_app';
$user = 'usuarioX';
$pass = 'contraseñaX';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la base de datos si no existe
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    echo "Base de dades comprovada/creada.<br>";

    // Seleccionar la base de datos
    $pdo->exec("USE `$dbName`");

    // Cargar el SQL de tablas desde tables.sql
    $sql = file_get_contents(__DIR__ . '/tables.sql');
    $pdo->exec($sql);

    echo "Taules Creades/Modificades Èxitosament!.<br>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}


// Instanciem el Router
$router = new Router();

/**
 * -------------------------------
 * RUTES GET I POST DE L'APLICACIÓ
 * -------------------------------
 */

// Ruta principal de la pàgina home
$router->get('/', 'HomeController@index');

// Llistat de totes les tasques
$router->get('/tasques', 'TaskController@index');

// Formulari de creació d'una nova tasca
$router->get('/tasques/create', 'TaskController@create');

// Processar la creació d'una nova tasca
$router->post('/tasques', 'TaskController@store');

// Formulari d'edició d'una tasca concreta
$router->get('/tasques/{id}/edit', 'TaskController@edit');

// Processar actualització d'una tasca concreta
$router->post('/tasques/{id}', 'TaskController@update');

// Eliminar una tasca concreta
$router->post('/tasques/{id}/delete', 'TaskController@delete');

/**
 * Ruta de prova amb funció anònima
 * Serveix per comprovar que el Router captura correctament els paràmetres dinàmics
 */
$router->get("/tasques/{id}", function($id) {
    echo "Has demanat la tasca amb ID: " . $id;
});

/**
 * Despatxar la ruta actual
 * Passa la URI del navegador al Router per gestionar la ruta corresponent
 */
$router->dispatch($_SERVER['REQUEST_URI']);

?>