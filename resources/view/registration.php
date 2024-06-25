<?php

$page = "registration";
include 'header.php';

$errors = $validator->getErrors();

if (isset($_SESSION['errors']['file'])) {
    $errors['file'] = $_SESSION['errors']['file'];
}
?>
<div class="container">
    <h2>User Registration</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $_POST['first_name'] ?? ''; ?>">
        <span class="error"><?php echo $errors['first_name'] ?? ''; ?></span><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $_POST['last_name'] ?? ''; ?>">
        <span class="error"><?php echo $errors['last_name'] ?? ''; ?></span><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo $_POST['phone_number'] ?? ''; ?>">
        <span class="error"><?php echo $errors['phone_number'] ?? ''; ?></span><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $_POST['username'] ?? ''; ?>">
        <span class="error"><?php echo $errors['username'] ?? ''; ?></span><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span class="error"><?php echo $errors['password'] ?? ''; ?></span><br>

        <label for="file_path">Profile Image:</label>
        <input type="file" id="file_path" name="file" accept="image/*">
        <span class="error"><?php echo $errors['file'] ?? ''; ?></span><br>

        <input type="submit" value="Register" name="submit">
    </form>
</div>
<?php include 'footer.php'; ?>


