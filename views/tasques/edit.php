<?php
// views/tasques/edit.php

// Mostrar errores si existen
if (!empty($errors)) {
    echo '<div class="alert alert-danger">';
    foreach ($errors as $fieldErrors) {
        foreach ($fieldErrors as $error) {
            echo "<p>{$error}</p>";
        }
    }
    echo '</div>';
}

// Valores de la tarea actual
$title = $_POST['title'] ?? $task->title;
$description = $_POST['description'] ?? $task->description;
$priority = $_POST['priority'] ?? $task->priority;
?>

<div class="container my-5">
    <h1>Editar tasca</h1>
    <form action="/tasques/<?= $task->id ?>" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Títol</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($title) ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripció</label>
            <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($description) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioritat</label>
            <select class="form-select" id="priority" name="priority">
                <option value="low" <?= $priority === 'low' ? 'selected' : '' ?>>Baixa</option>
                <option value="medium" <?= $priority === 'medium' ? 'selected' : '' ?>>Mitjana</option>
                <option value="high" <?= $priority === 'high' ? 'selected' : '' ?>>Alta</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Desar canvis</button>
        <a href="<?= BASE_PATH ?>/tasques" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>