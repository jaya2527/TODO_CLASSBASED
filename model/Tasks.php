<?php

namespace model;

use app\DbConnect\Db;
use PDO;
use utils\Util;

class Tasks
{
    public static function addTask($taskName)
    {

        $user_id = $_SESSION['user_id'];
        $connect = Db::connect();
        $stmt = $connect->prepare("INSERT INTO tasks (user_id, task) VALUES (:user_id, :taskName)");

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':taskName', $taskName);
        $success = $stmt->execute();

        return $success ? true : false;
    }

   public static function updateTask($taskName)
    {

        $task_id = $_POST["task_id"];
        $task = $_POST["task"];
        $user_id = $_SESSION['user_id'];

        $connect = Db::connect();
        $stmt = $connect->prepare("UPDATE tasks SET task=:task WHERE id=:task_id AND user_id=:user_id");

        $stmt->bindParam(':task', $task);
        $stmt->bindParam(':task_id', $task_id);
        $stmt->bindParam(':user_id', $user_id);
        $success = $stmt->execute();

        return $success ? true : false;
    }

  public static  function deleteTask($taskName)
    {
        $user_id = $_SESSION['user_id'];
        $task_id = $_GET["id"];

        $connect=Db::connect();
        $stmt = $connect->prepare("DELETE from tasks WHERE id=:task_id AND user_id=:user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':task_id', $task_id);
        $stmt->execute();
        $success = $stmt->execute();


        return $success ? true : false;

    }

   public static function mark_as($task_id, $mark_as)
    {
        $user_id = $_SESSION['user_id'];
        $connect=Db::connect();

        $stmt = $connect->prepare("UPDATE tasks SET completed=:completed WHERE id=:task_id AND user_id=:user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':task_id', $task_id);
        $stmt->bindParam(':completed', $mark_as);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

   public static function get_tasks($isCompleted = '')
    {

        $user_id = $_SESSION['user_id'];
        $connect=Db::connect();
        if ($isCompleted !== '') {
            $sql = "SELECT * FROM tasks WHERE completed = :completed and user_id = :user_id";

            $stmt = $connect->prepare($sql);
            $stmt->bindParam(':completed', $isCompleted, PDO::PARAM_INT);
        } else {
            $sql = "SELECT * FROM tasks WHERE user_id = :user_id";
            $stmt = $connect->prepare($sql);
        }
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}



