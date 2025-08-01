<?php
function connect_database(): PDO {
    return new PDO("mysql:host=127.0.0.1;dbname=app-database", "root", "root");
}

// CRUD User
function create_user(string $email, string $password): int | null {
    $database = connect_database();

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $query = $database->prepare("INSERT INTO User (email, password) VALUES (:email, :password)");
    $success = $query->execute([
        "email" => $email,
        "password" => $hashed_password
    ]);

    return $success ? (int)$database->lastInsertId() : null;
}


function get_user_by_email(string $email): array | null {
    $database = connect_database();

    $query = $database->prepare("SELECT * FROM User WHERE email = :email");
    $query->execute([
        "email" => $email
    ]);

    $user = $query->fetch(PDO::FETCH_ASSOC);
    return $user ?: null;
}

// CRUD Task
function add_task(string $name, string $description, int $user_id): int | null {
    $database = connect_database();

    $query = $database->prepare("INSERT INTO Task (name, description, user_id) VALUES (:name, :description, :user_id)");
    $success = $query->execute([
        "name" => $name,
        "description" => $description,
        "user_id" => $user_id
    ]);

    return $success ? (int) $database->lastInsertId() : null;
}

function get_tasks_by_user_id(int $user_id): array {
    $database = connect_database();

    $query = $database->prepare("SELECT * FROM Task WHERE user_id = :user_id");
    $query->execute([
        "user_id" => $user_id
    ]);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function get_task_by_id_and_user(int $task_id, int $user_id): array | null {
    $database = connect_database();

    $query = $database->prepare("SELECT * FROM Task WHERE id = :id AND user_id = :user_id");
    $query->execute([
        "id" => $task_id,
        "user_id" => $user_id
    ]);

    $task = $query->fetch(PDO::FETCH_ASSOC);
    return $task ?: null;
}

function delete_task(int $task_id, int $user_id): bool {
    $database = connect_database();

    $query = $database->prepare("DELETE FROM Task WHERE id = :id AND user_id = :user_id");
    return $query->execute([
        "id" => $task_id,
        "user_id" => $user_id
    ]);
}

function validate_task(int $task_id, int $user_id): bool {
    $database = connect_database();

    $query = $database->prepare("UPDATE Task SET is_done = TRUE WHERE id = :id AND user_id = :user_id");
    return $query->execute([
        "id" => $task_id,
        "user_id" => $user_id
    ]);

}

function get_all_tasks(int $user_id): array | null {
    $database = connect_database();
    $query = $database->prepare("SELECT * FROM Task WHERE user_id = :user_id ORDER BY id DESC");
    $query->execute(["user_id" => $user_id]);
    $tasks = $query->fetchAll(PDO::FETCH_ASSOC);
    return $tasks ?: null;
}
