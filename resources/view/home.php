<?php
$page = "index";

include_once "header.php";

use model\Tasks;
use app\Services\Auth;
use utils\Util;
$errors = $validator->getErrors();

?>
    <div class="card text-center">
        <div class="card-header fw-bolder fs-2 text text-danger ">
            <h3 class="text-align-center"> Welcome!!! <?php echo Auth::getUsername(); ?></h3>
        </div>
        <div class="card-body">
            <h1 class="card-title">TODO TASK</h1>
            <p class="card-text"></p>
        </div>
        <div class="card-footer text-body-secondary"></div>
        <form action="" method="POST">
            <label>
                <input type="text" name="task" placeholder="Enter task">
            </label>
            <small class="error"><?php echo $errors['task'] ?? '';
                ?></small>
            <input type="hidden" value="add_task" name="action">
            <button type="submit">Add Task</button>
        </form>
    </div>
<?php
?>
    <div class="task-wrapper">
        <div class="completed-tasks task-width">
            <h3 class="text-align-center">Completed Task</h3>
            <?php
            $newCompleted = Tasks:: get_tasks(1);
            if (count($newCompleted) > 0) {
                foreach ($newCompleted as $row) {
                    include 'print.php';
                }
            } else {
                echo "no Task";
            }
            ?>
        </div>
        <!--        THE CODE IS HERE IN-COMPLETED TASKS    -->
        <div class="incompleted-tasks task-width">
            <h3 class="text-align-center">In-Completed Task</h3>
            <?php
            $isNotCompleted = Tasks:: get_tasks(0);
            if (count($isNotCompleted) > 0) {
                foreach ($isNotCompleted as $row) {
                    include 'print.php';
                }
            } else {
                echo "no Task";
            }
            ?>
        </div>
    </div>
<?php include_once "footer.php"; ?>