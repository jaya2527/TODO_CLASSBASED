<?php
$page = "login";
include_once "header.php";
$errors = $validator->getErrors();

?>

    <form action="" method="post">
        <h3>Login Here</h3>

        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $_POST['username'] ?? '';?>">
            <small class="error"><?php echo $errors['username'] ?? '';?></small>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $_POST['password'] ?? '';?>" >
            <small class="error"><?php echo $errors['password'] ?? '';?></small>
        </div>

        <div>
            <input class="button" type="submit" name="submit" value="Login">
        </div>
        <a class="link forget" href="/forget.php">Forgot Password?</a>

        <div class=col-12">
            <a class="mx-auto" href="/registration.php">Create a Account</a>
        </div>
    </form>
<?php
include_once "footer.php";