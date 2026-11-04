
<?php

require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tasks = $_POST["tasks"] ?? "";

    $taskList = explode("\n", $tasks);

    $sql = "INSERT INTO tasks (task_name)
            VALUES (:task_name)";

    $stmt = $conn->prepare($sql);

    foreach ($taskList as $task) {

        $task = trim($task);

        if ($task !== "") {

            $stmt->execute([
                ":task_name" => $task
            ]);

        }

    }

}

header("Location: ../index.php");
exit;

?>
