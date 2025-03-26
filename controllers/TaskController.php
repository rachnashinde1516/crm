<?php
require_once '../config/config.php';
require_once '../models/Task.php';

use App\Models\Task;

class TaskController
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }
    // View all Tasks
    public function viewTasks()
    {
        $Tasks = Task::getAllTasks();
        require 'views/list_tasks.php';
    }
 
    // Create a new Task record
    public function createTask()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['lead_id']) || empty($_POST['label']) || empty($_POST['description']) || empty($_POST['due_date'])) {
                $_SESSION['error'] = 'All fields are required.';
                header('Location: ../views/task/create_task.php');
                exit();
            }

            $Task = new Task($this->db);
            $Task->lead_id = htmlspecialchars(strip_tags($_POST['lead_id']));
            $Task->label = htmlspecialchars(strip_tags($_POST['label']));
            $Task->description = htmlspecialchars(strip_tags($_POST['description']));
            $Task->due_date = htmlspecialchars(strip_tags($_POST['due_date']));

            if ($Task->create()) {
                $_SESSION['success'] = 'Task added successfully.';
                header('Location: ../views/task/list_tasks.php');
                exit();
            } else {
                $_SESSION['error'] = 'Failed to add Task. Please try again.';
                header('Location: ../views/task/create_task.php');
                exit();
            }
        } else {
            header('Location: ../views/task/create_task.php');
            exit();
        }

    }
}
?>
