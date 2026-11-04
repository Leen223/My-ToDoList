<?php

// Show PHP errors (turn these off on a live server)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connect to database
require_once "config/db.php";

// Get all tasks
$sql  = "SELECT * FROM tasks ORDER BY id DESC";
$stmt = $conn->query($sql);

$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My To Do List</title>
<link rel="stylesheet" href="style.css?v=<?php echo filemtime(__DIR__ . '/style.css'); ?>"></head>

<body>

    <div class="todo-container">

        <h1>My To Do List</h1>

        <!-- Add Task -->
        <h3>Add New Task</h3>

        <form action="actions/add.php" method="POST" class="inline-form">
            <input
                type="text"
                name="task_name"
                placeholder="Enter your task..."
                required
            >
            <button type="submit">Add Task</button>
        </form>

        <!-- Bulk Add -->
        <h3>Add Tasks in Bulk</h3>

        <form action="actions/bulk_add.php" method="POST" class="inline-form">
            <textarea
                name="tasks"
                placeholder="Enter each task on a new line..."
                required
            ></textarea>
            <button type="submit">Add All Tasks</button>
        </form>

        <!-- Display Tasks -->
        <h2>My Tasks</h2>

        <?php if (count($tasks) > 0): ?>

            <ul>
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <span class="<?php echo $task['is_completed'] ? 'completed' : ''; ?>">
                            <?php echo htmlspecialchars($task['task_name']); ?>
                        </span>

                        <div class="task-buttons">

                            <!-- Update Task -->
                            <form action="actions/update.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo (int)$task['id']; ?>">
                                <button type="submit">
                                    <?php echo $task['is_completed'] ? 'Undo' : 'Done'; ?>
                                </button>
                            </form>

                            <!-- Delete Task -->
                            <form action="actions/delete.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo (int)$task['id']; ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>

                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

        <?php else: ?>

            <p class="empty">No tasks yet. Add your first task!</p>

        <?php endif; ?>

    </div>

</body>

</html>