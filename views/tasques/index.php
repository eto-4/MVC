<?php
// views/tasques/index.php

require_once APP_ROOT . '/helpers/FlashMessages.php';
?>

<div class="container my-5">
    <h1>Llistat de tasques</h1>

    <!-- Mostrar flash messages -->
    <?php FlashMessages::display(); ?>

    <a href="<?= BASE_PATH ?>/tasques/create" class="btn btn-success mb-3">Crear nova tasca</a>

    <?php if (!empty($tasks)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Títol</th>
                    <th>Descripció</th>
                    <th>Cost (€)</th>
                    <th>Estat</th>
                    <th>Progrés (hores)</th>
                    <th>Data d'entrega</th>
                    <th>Prioritat</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task->id ?></td>
                        <td><?= htmlspecialchars($task->title) ?></td>
                        <td><?= htmlspecialchars($task->description) ?></td>
                        <td><?= htmlspecialchars("$task->cost" . "€") ?></td>
                        <td><?= htmlspecialchars("$task->state") ?></td>
                        <td><?= htmlspecialchars("$task->used_hours" . "/" . "$task->expected_hours"."h") ?></td>
                        <td><?= htmlspecialchars("$task->due_date") ?></td>
                        <td><?= ucfirst($task->priority) ?></td>
                        <td>
                            <a href="<?= BASE_PATH ?>/tasques/<?= $task->id ?>/edit" class="btn btn-primary btn-sm">Editar</a>

                            <form action="<?= BASE_PATH ?>/tasques/<?= $task->id ?>/delete" method="POST" style="display:inline-block" onsubmit="return confirm('Segur que vols eliminar aquesta tasca?');">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hi ha tasques disponibles.</p>
    <?php endif; ?>
</div>
