
<?php

require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $task_name = trim($_POST["task_name"] ?? "");

    if ($task_name !== "") {

        $sql = "INSERT INTO tasks (task_name)
                VALUES (:task_name)";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ":task_name" => $task_name
        ]);

    }

}

header("Location: ../index.php");
exit;

?>
