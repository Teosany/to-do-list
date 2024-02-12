<?php
spl_autoload_register(function ($class){
    require_once($class.'.class.php');
});

$taskM = new taskManager;

if (isset($_POST)) {
    $taskM->setId($_POST['id']);
    $taskM->verifTask($_POST['product']);
}
?>;


<!--it the same but with methode fetch-->
<?php
//const DB_HOST = 'localhost';
//const DB_USER = 'root';
//const DB_PASS = 'root';
//const DB_NAME = 'todo';
//
//try {
//    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
//
//    $data = file_get_contents('php://input');
//
//    if (isset($_POST)) {
//        $data = json_decode($data, true);
//
//        $id = $data['id'];
//        $product = $data['product'];
//
//        $sql = "UPDATE tasks SET task = :product WHERE id = :id";
//
//        $query = $dbh->prepare($sql);
//        $query->bindParam(':id', $id, PDO::PARAM_INT);
//        $query->bindParam(':product', $product);
//        $query->execute();
//    }
//} catch (PDOException $e) {
//    exit("Error: " . $e->getMessage());
//}
//?><!--;-->


<!-- it the same but with methode XMLHttpRequest-->
<?php
//const DB_HOST = 'localhost';
//const DB_USER = 'root';
//const DB_PASS = 'root';
//const DB_NAME = 'todo';
//
//try {
//$dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
//
//if (isset($_POST)) {
//
//$id = $_POST['id'];
//$product = $_POST['product'];
//
//$sql = "UPDATE tasks SET task = :product WHERE id = :id";
//
//$query = $dbh->prepare($sql);
//$query->bindParam(':id', $id, PDO::PARAM_INT);
//$query->bindParam(':product', $product);
//$query->execute();
//}
//} catch (PDOException $e) {
//exit("Error: " . $e->getMessage());
//}
//?><!--;-->