<?php

class taskManager extends AbstructTaskManager
{
    protected $_id;
    protected $_product;
    protected $_status;
    protected $_dbh;

    public function __construct()
    {
        $this->_dbh = new DataBase();
    }
    public function getId()
    {
        return $this->_id;
    }
    public function getProduct()
    {
        return $this->_product;
    }
    public function getStatus()
    {
        return $this->_status;
    }

    public function addTask(string $task)
    {
        $this->_product = $task;

        $sql = "INSERT INTO tasks (task) VALUES (?)";

        $query = $this->_dbh->prepare($sql);
        $query->execute([$this->_product]) or die(print_r($this->_dbh->errorInfo(), true));
    }

    public function editTask(string $task): void
    {
        $this->_product = $task;

        $sql = "UPDATE tasks SET task = :product WHERE id = :id";

        $query = $this->_dbh->prepare($sql);
        $query->bindParam(':id', $this->_id, PDO::PARAM_INT);
        $query->bindParam(':product', $this->_product);
        $query->execute();
    }

    public function verifTask(string $task): void
    {
        $this->_product = $task;

        $sql = $this->_dbh->query("SELECT task FROM tasks WHERE id = " . $this->_id);
        $oldTask = $sql->fetch();
        $oldTask = $oldTask[0];
        if ($oldTask != $this->_product) {
            echo("Task #" . $this->_id . ' has been updated with new content: "' . $this->_product . '"');
            $this->editTask($this->_product);
        } else {
            echo("The task has not been changed");
            exit();
        }
    }

    public function delTask(int $id): void
    {
        $sql = "DELETE FROM tasks WHERE id=:id";

        $query = $this->_dbh->prepare($sql);
        $query->execute([
            'id' => $id
        ]);

    }

    public function updateTask(int $id): void
    {
        $sql = "UPDATE tasks SET status = 'Done' WHERE id=:id";

        $query = $this->_dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

    }

    public function getAllTasks()
    {
        $query = $this->_dbh->query("SELECT task, id, status FROM tasks");

        $allResult = $query->fetchAll(PDO::FETCH_OBJ);

        $allTasks = [];
        foreach ($allResult as $elem) {
            $obj = new TaskManager();
            $obj->setId($elem->id);
            $obj->setProduct($elem->task);
            $obj->setStatus($elem->status);
            $allTasks[] = $obj;
        }
        return $allTasks;
    }

    public function setId(int $id)
    {
        if ($id > 0) {
            $this->_id = $id;
        }
    }
    public function setProduct(string $product)
    {
        if (strlen($product) > 0) {
            $this->_product = $product;
        }
    }
    public function setStatus($status)
    {
            $this->_status = $status;
    }
}

abstract class AbstructTaskManager
{
    abstract public function addTask(string $task);

    abstract public function editTask(string $task);

    abstract public function delTask(int $id);

    abstract public function updateTask(int $id);
    abstract public function verifTask(string $task);
    abstract public function getAllTasks();
}
