<?php

spl_autoload_register(function ($class){
    require_once($class.'.class.php');
});

$taskM = new taskManager;

if (isset($_POST['submit'])) {
    if (empty($_POST['task'])) {
        $errors = "You must fill in the task";
    } else {
        $taskM->addTask($_POST['task']);
    }
    $_POST['task'] = '';
    header('Location: index.php');
}
if (isset($_GET['del_task'])) {
    $taskM->delTask($_GET['del_task']);
    header('Location: index.php');
}
if (isset($_GET['update_task'])) {
    $taskM->updateTask($_GET['update_task']);
    header('Location: index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>ToDo List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="project.js" defer></script>
<body>
<div class="heading">
    <h2>ToDo List</h2>
</div>
<form method="post" action="index.php" class="input_form">
    <?php if (isset($errors)) { ?>
        <p><?php echo $errors; ?></p>
    <?php } ?>
    <input type="text" name="task" class="task_input">
    <button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
</form>


<table>
    <thead>
    <tr>
        <th>N</th>
        <th>Tasks</th>
        <th>Status</th>
        <th colspan="2" style="width: 60px;">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $row = $taskM->getAllTasks();
    $i = 1;
    if (!empty($row)) :
        foreach ($row as $task) : ?>
            <tr>
                <td> <?php echo $i; ?> </td>
                <td contenteditable="plaintext-only" class="task" type="radio"
                    id="<?php echo $task->getId(); ?>"><?php echo htmlentities($task->getProduct()); ?></td>
                <td class="status"> <?php echo $task->getStatus(); ?> </td>
                <?php
                if ($task->getStatus() != "Done" && $task->getId() != "") {
                    ?>
                    <td class="update">
                        <a href='index.php?update_task=<?php echo $task->getId(); ?>'> y</a>
                    </td>
                    <?php
                } else {
                    ?>
                    <td class="none">
                        <a href=""> </a>
                    </td>
                    <?php
                }
                ?>
                <td class="delete">
                    <a href='index.php?del_task=<?php echo $task->getId(); ?>' onclick="return confirm('Tu es sure?')">
                        x</a>
                </td>
            </tr>
            <?php $i++;
        endforeach;
    endif;
    ?>
    </tbody>
</table>

</body>
</html>