

<?php
session_start();
require_once 'auto_loader.php';

use model\Tasks;
use app\Services\Auth;
use app\Services\Validator;
use utils\Util;

Auth::isLoggedOut();

$data = array_merge($_POST, $_GET);
$validator = new Validator($data, 'task');


$action = $data['action'] ?? '';
$validator->handleTaskValidator($action);
if (empty($validator->getErrors())) {
    switch ($action) {
        case 'add_task':
                !Tasks::addTask($data['task']);
            break;
        case 'update_task':
                Tasks::updateTask($data["task_id"]);
            break;
        case 'delete_task':
                Tasks::deleteTask($data['id']);
                Util::redirect('index');

            break;
    }
}


if (isset($_GET['action']) && $_GET["action"] === "markAs" && isset($_GET['checked'])) {
    Tasks::mark_as($_GET['id'], $_GET['checked']);
    Util::redirect('index');
}











include_once "resources/view/home.php";


