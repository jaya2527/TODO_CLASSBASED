
<div class="task">
    <div>
        <p><?php echo $row["task"] ?></p>
    </div>
    <div class="actions">
        <form action="" method="POST">
            <input type="hidden" name="task_id" value="<?php echo $row['id']?>" >
            <label>
                <input type="text" name="task" value="<?php echo $row["task"] ?>" style="display:none;">
            </label>
        <small class="error"><?php echo $errors['update_task'][$row['id']] ?? ''; ?></small>
            <button type="button" class="btn btn-warning" onclick="toggleEdit(this)">Edit</button>
            <button type="submit" name="action" value="update_task" style="display:none;">Edit</button>
        </form>
        <?php if ($row['completed'] == 0) :?>
            <a  href=<?php echo "index.php?action=delete_task&id=" . $row['id']  ?>><i class=" fa-2x bi bi-trash"></i></a>
            <a  href=<?php echo "index.php?action=markAs&id=" . $row['id'] . '&checked=1' ?>><i class="fa-3x bi bi-check-square-fill"></i> </a>
        <?php else: ?>
            <a  href=<?php echo "index.php?action=delete_task&id=" . $row['id'] ?>><i class="fa-2x bi bi-trash"></i></a>
            <a  href=<?php echo "index.php?action=markAs&id=" . $row['id'] . '&checked=0' ?>><i class="fa-3x bi bi-check-square-fill"></i> </a>
        <?php endif; ?>
    </div>
</div>

<script>
    function toggleEdit(button) {
        // Find the input field within the same parent div
        var inputField = button.parentElement.querySelector('input[type="text"]');
        // Toggle its display style
        if (inputField.style.display === "none") {
            inputField.style.display = "block";
            // Hide the edit button
            button.style.display = "none";
            // Show the submit button
            button.nextElementSibling.style.display = "inline-block";
            // Focus on the input field
            inputField.focus();
        } else {
            inputField.style.display = "none";
            button.nextElementSibling.style.display = "none";
            button.style.display = "inline-block";
        }
    }
</script>




