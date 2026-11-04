
<?php

require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if ($id) {

        $sql = "UPDATE tasks
                SET is_completed = NOT is_completed
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

    }

}

header("Location: ../index.php");
exit;

?>
