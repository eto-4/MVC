<?php

require_once APP_ROOT . '/models/Tasca.php';
require_once APP_ROOT . '/config/Database.php';
require_once APP_ROOT . '/helpers/Sanitizer.php';
require_once APP_ROOT . '/helpers/Validator.php';

/**
 * Controlador de tasques
 *
 * Gestiona CRUD de tasques utilitzant els helpers Sanitizer i Validator.
 */
class TaskController
{
    private PDO $pdo;

    public function __construct()
    {
        // Obtenim la connexió PDO des del singleton Database
        $this->pdo = Database::getInstance()->getConnection();
    }

    /**
     * Llista totes les tasques
     */
    public function index(): void
    {
        $tasks = Task::findAll($this->pdo);

        require APP_ROOT . '/views/layouts/header.php';
        require APP_ROOT . '/views/tasques/index.php';
        require APP_ROOT . '/views/layouts/footer.php';
    }

    /**
     * Mostra el formulari de creació
     */
    public function create(): void
    {
        require APP_ROOT . '/views/layouts/header.php';
        require APP_ROOT . '/views/tasques/create.php';
        require APP_ROOT . '/views/layouts/footer.php';
    }

    /**
     * Desa una nova tasca
     */
    public function store(): void
    {
        $data = Sanitizer::clean($_POST);

        // Validacions
        $validator = new Validator($data);
        $validator->required('title')->string('title', 3, 255);
        $validator->enum('priority'); // 'low', 'medium', 'high' segons Validator

        if (!$validator->isValid()) {
            $errors = $validator->errors();
            // Tornem al formulari amb errors
            require APP_ROOT . '/views/tasques/create.php';
            return;
        }

        // Creem la tasca
        $task = new Task($this->pdo);
        $task->title       = $data['title'];
        $task->description = $data['description'] ?? '';
        $task->priority    = $data['priority'] ?? 'medium';

        $task->save();

        header('Location:' . BASE_PATH . '/tasques');
        exit;
    }

    /**
     * Mostra el formulari d'edició d'una tasca
     */
    public function edit(int $id): void
    {
        $task = new Task($this->pdo);

        if (!$task->load($id)) {
            http_response_code(404);
            require APP_ROOT . '/../views/home/404.php';
            return;
        }

        require APP_ROOT . '/views/layouts/header.php';
        require APP_ROOT . '/views/tasques/edit.php';
        require APP_ROOT . '/views/layouts/footer.php';
    }

    /**
     * Actualitza una tasca existent
     */
    public function update(int $id): void
    {
        $task = new Task($this->pdo);

        if (!$task->load($id)) {
            http_response_code(404);
            require APP_ROOT . '/views/home/404.php';
            return;
        }

        $data = Sanitizer::clean($_POST);

        // Validacions igual que en store
        $validator = new Validator($data);
        $validator->required('title')->string('title', 3, 255);
        $validator->enum('priority');

        if (!$validator->isValid()) {
            $errors = $validator->errors();
            require APP_ROOT . '/views/tasques/edit.php';
            return;
        }

        $task->title       = $data['title'];
        $task->description = $data['description'] ?? '';
        $task->priority    = $data['priority'] ?? 'medium';

        $task->update();

        header('Location:' . BASE_PATH . '/tasques');
        exit;
    }

    /**
     * Elimina una tasca
     */
    public function delete(int $id): void
    {
        $task = new Task($this->pdo);

        if ($task->load($id)) {
            $task->delete();
        }

        header('Location:' . BASE_PATH . '/tasques');
        exit;
    }
}