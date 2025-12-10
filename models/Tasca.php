<?php

class Task
{
    private $pdo;

    public $id;
    public $title;
    public $description = '';
    public $tags = [];
    public $cost = 0;
    public $due_date;
    public $expected_hours = 20;
    public $used_hours = 0;
    public $image_url;
    public $image_local_name;
    public $image_cloud_public_id;
    public $priority = 'medium';
    public $state = 'pending';
    public $finished_at;
    public $created_at;
    public $updated_at;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        // Per defecte el due_date es per 24hores mes tard.
        $this->due_date = date('Y-m-d H:i:s', time() + 24 * 60 * 60);
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    // Guardar nova tasca
    public function save()
    {
        $sql = "INSERT INTO tasks (
                    title, description, tags, cost, due_date, expected_hours, used_hours,
                    image_url, image_local_name, image_cloud_public_id,
                    priority, state, finished_at, created_at, updated_at
                ) VALUES (
                    :title, :description, :tags, :cost, :due_date, :expected_hours, :used_hours,
                    :image_url, :image_local_name, :image_cloud_public_id,
                    :priority, :state, :finished_at, :created_at, :updated_at
                )";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':tags' => json_encode($this->tags),
            ':cost' => $this->cost,
            ':due_date' => $this->due_date,
            ':expected_hours' => $this->expected_hours,
            ':used_hours' => $this->used_hours,
            ':image_url' => $this->image_url,
            ':image_local_name' => $this->image_local_name,
            ':image_cloud_public_id' => $this->image_cloud_public_id,
            ':priority' => $this->priority,
            ':state' => $this->state,
            ':finished_at' => $this->finished_at,
            ':created_at' => $this->created_at,
            ':updated_at' => $this->updated_at,
        ]);

        $this->id = $this->pdo->lastInsertId();
    }

    // Actualizar la tasca existent
    public function update()
    {
        $this->updated_at = date('Y-m-d H:i:s');

        // Si es marca com a completada i no té data de finalització
        if ($this->state === 'completed' && empty($this->finished_at)) {
            $this->finished_at = date('Y-m-d H:i:s');
        }

        $sql = "UPDATE tasks SET
                    title = :title,
                    description = :description,
                    tags = :tags,
                    cost = :cost,
                    due_date = :due_date,
                    expected_hours = :expected_hours,
                    used_hours = :used_hours,
                    image_url = :image_url,
                    image_local_name = :image_local_name,
                    image_cloud_public_id = :image_cloud_public_id,
                    priority = :priority,
                    state = :state,
                    finished_at = :finished_at,
                    updated_at = :updated_at
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':tags' => json_encode($this->tags),
            ':cost' => $this->cost,
            ':due_date' => $this->due_date,
            ':expected_hours' => $this->expected_hours,
            ':used_hours' => $this->used_hours,
            ':image_url' => $this->image_url,
            ':image_local_name' => $this->image_local_name,
            ':image_cloud_public_id' => $this->image_cloud_public_id,
            ':priority' => $this->priority,
            ':state' => $this->state,
            ':finished_at' => $this->finished_at,
            ':updated_at' => $this->updated_at,
            ':id' => $this->id,
        ]);
    }

    // Cargar una tasca per ID
    public function load($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $this->id = $data['id'];
            $this->title = $data['title'];
            $this->description = $data['description'];
            $this->tags = json_decode($data['tags'], true) ?: [];
            $this->cost = $data['cost'];
            $this->due_date = $data['due_date'];
            $this->expected_hours = $data['expected_hours'];
            $this->used_hours = $data['used_hours'];
            $this->image_url = $data['image_url'];
            $this->image_local_name = $data['image_local_name'];
            $this->image_cloud_public_id = $data['image_cloud_public_id'];
            $this->priority = $data['priority'];
            $this->state = $data['state'];
            $this->finished_at = $data['finished_at'];
            $this->created_at = $data['created_at'];
            $this->updated_at = $data['updated_at'];
        }
    }
}