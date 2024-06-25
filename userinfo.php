<?php
session_start();
require_once 'auto_loader.php';
$page='userinfo';
include_once "./resources/view/header.php";
use app\Services\Auth;

$user = Auth::getCurrentUserInfo();

?>
    <div class="card text-center">
        <div class="card-header fw-bolder fs-2 text text-danger">
            USER DETAILS
        </div>
    <div class="card mb-3 position-relative py-2 px-4 border border-secondary cont ms-auto container "
         style="max-width: 540px;">
        <div class="row g-0 ">
            <div class="col-md-4">
                <img src="<?php echo $user['file_path'];?>" class="img-fluid rounded-circle rounded-5 mt-4 " alt="image">
            </div>
            <div class="col-md-8 ">
                <div class="card-body col g-4">
                    <ul class="list-group list-group-flush text-center list-group-horizontal">
                        <li class="list-group-item "><strong>First Name
                                <br></strong><?php echo $user['first_name'] ?></li>
                        <li class="list-group-item"><strong>Last Name
                                <br></strong><?php echo $user['last_name'] ?></li>
                    </ul>
                    <ul class="list-group list-group-flush text-center list-group-horizontal">
                        <li class="list-group-item "><strong>Username
                                <br></strong><?php echo $user['username']; ?></li>
                        <li class="list-group-item"><strong>Phone Number<br>
                            </strong><?php echo $user['phone_number']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>





<?php include_once "./resources/view/footer.php"; ?>