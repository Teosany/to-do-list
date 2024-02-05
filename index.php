<!doctype html>
<html lang="en">
<head>
    <title>ToDo List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="project.js" defer></script>
<body>
<?php
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = 'root';
const DB_NAME = 'todo';

$errors = "";

try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    if (isset($_POST['submit'])) {
        if (empty($_POST['task'])) {
            $errors = "You must fill in the task";
        } else {
            $task = $_POST['task'];
            $sql = "INSERT INTO tasks (task) VALUES (?)";

            $query = $dbh->prepare($sql);
//            $query->bindParam(':task', $task, PDO::PARAM_STR);
            $query->execute([$task]) or die(print_r($dbh->errorInfo(), true));
            header('location: index.php');
        }
    }
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];

        $sql = "DELETE FROM tasks WHERE id=:id";

        $query = $dbh->prepare($sql);
//        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute([
                'id' => $id
        ]);

        header('location: index.php');
    }
    if (isset($_GET['update_task'])) {
        $id = $_GET['update_task'];

        $sql = "UPDATE tasks SET status = 'Done' WHERE id=:id";

        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        header('location: index.php');
    }
}

catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
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
    $sql = $dbh->query("SELECT task, id, status FROM tasks");
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $i = 1;

    while ($row = $sql->fetch()) : ?>
        <tr>
            <td> <?php echo $i; ?> </td>
            <td contenteditable="plaintext-only" class="task" type="radio"
                id="<?php echo $row['id']?>"><?php echo $row['task']; ?></td>
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
    endwhile;?>
    </tbody>
</table>

</body>
</html>