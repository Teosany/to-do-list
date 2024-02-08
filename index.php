<!doctype html>
<html lang="en">
<head>
    <title>ToDo List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="project.js" defer></script>
<body>
<?php
include('database.class.php');
include('taskManager.class.php');

$dbh = new DataBase;
$taskM = new TaskManager;

if (isset($_POST['submit'])) {
    if (empty($_POST['task'])) {
        $errors = "You must fill in the task";
    } else {
        $taskM->setDbh($dbh);
        $taskM->addTask($_POST['task']);
    }
}
if (isset($_GET['del_task'])) {
    $taskM->setDbh($dbh);
    $taskM->delTask($_GET['del_task']);
}
if (isset($_GET['update_task'])) {
    $taskM->setDbh($dbh);
    $taskM->updateTask($_GET['update_task']);
}
?>


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
    $taskM->setDbh($dbh);
    $sql = $taskM->getAllTasks();
    $i = 1;
    while ($row = $sql->fetch()) : ?>
        <tr>
            <td> <?php echo $i; ?> </td>
            <td contenteditable="plaintext-only" class="task" type="radio"
                id="<?php echo $row['id'] ?>"><?php echo $row['task']; ?></td>
            <td class="status"> <?php echo $row['status']; ?> </td>
            <?php
            if ($row['status'] != "Done" && $row['id'] != "") {
                ?>
                <td class="update">
                    <a href='index.php?update_task=<?php echo $row['id']; ?>'> y</a>
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
                <a href='index.php?del_task=<?php echo $row['id']; ?>'> x</a>
            </td>
        </tr>
        <?php $i++;
    endwhile; ?>
    </tbody>
</table>

</body>
</html>