<?php

class TaskModel
{
  private $conn;

  public function __construct($host, $username, $password, $dbname)
  {
    $this->conn = new mysqli($host, $username, $password, $dbname);
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getTasks($currentPage = 1, $itemPerPage = ITEM_PER_PAGE)
  {
    $sql = "SELECT COUNT(*) AS totalTasks FROM TASK";
    $result = $this->conn->query($sql);
    $totalTasks = $result->fetch_assoc()['totalTasks'];

    $offset = ($currentPage - 1) * $itemPerPage;

    $sql = "SELECT TASK.*, CATEGORY.name AS category_name FROM TASK JOIN CATEGORY ON TASK.category_id = CATEGORY.id LIMIT $offset, $itemPerPage";
    $result = $this->conn->query($sql);
    $tasks = array();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        array_push($tasks, $row);
      }
    }

    return array(
      'totalTasks' => $totalTasks,
      'tasks' => $tasks
    );
  }

  public function getTaskById($taskId)
  {
    $sql = "SELECT TASK.*, CATEGORY.name AS category_name FROM TASK JOIN CATEGORY ON TASK.category_id = CATEGORY.id WHERE TASK.id = $taskId";
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
      $task = $result->fetch_assoc();
    } else {
      $task = [];
    }

    return $task;
  }

  public function addTask($name, $description, $category_id, $start_date, $due_date)
  {
    $stmt = $this->conn->prepare("INSERT INTO TASK (name, description, category_id, start_date, due_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $name, $description, $category_id, $start_date, $due_date);

    $result = $stmt->execute();

    return $result ? true : false;
  }

  public function updateTask($id, $name, $description, $category_id, $start_date, $due_date)
  {
    $stmt = $this->conn->prepare("UPDATE TASK SET name = ?, description = ?, category_id = ?, start_date = ?, due_date = ? WHERE id = ?");
    $stmt->bind_param("ssissi", $name, $description, $category_id, $start_date, $due_date, $id);

    $result = $stmt->execute();

    return $result ? true : false;
  }

  public function updateTaskStatus($taskId, $status)
  {
    $query = "UPDATE TASK SET status = '$status'";

    if ($status === 'FINISHED') {
      $query .= ", finished_date = NOW()";
    } else {
      $query .= ", finished_date = NULL";
    }

    $query .= " WHERE id = $taskId";

    $result = $this->conn->query($query);

    return $result ? true : false;
  }

  public function deleteTasks($taskIds)
  {
    $taskIdsString = implode(',', $taskIds);
    $query = "DELETE FROM `TASK` WHERE `id` IN ($taskIdsString)";
    $result = $this->conn->query($query);
    return $result ? true : false;
  }

  public function searchTasks($keyword = null, $category_id = null, $status = null, $dueDate = null, $currentPage = 1, $itemPerPage = 10)
  {
    $sql = "SELECT COUNT(*) AS totalTasks FROM TASK WHERE 1=1";
    if (!empty($keyword)) {
      $sql .= " AND (name LIKE '%$keyword%' OR description LIKE '%$keyword%')";
    }
    if (!empty($category_id)) {
      $sql .= " AND category_id = $category_id";
    }
    if (!empty($status)) {
      $sql .= " AND status = '$status'";
    }
    if (!empty($dueDate)) {
      $sql .= " AND due_date <= DATE_ADD(CURRENT_DATE, INTERVAL $dueDate DAY)";
    }

    $result = $this->conn->query($sql);
    $totalTasks = $result->fetch_assoc()['totalTasks'];

    $sql = "SELECT TASK.*, CATEGORY.name AS category_name FROM TASK LEFT JOIN CATEGORY ON TASK.category_id = CATEGORY.id WHERE 1=1";
    if (!empty($keyword)) {
      $sql .= " AND (TASK.name LIKE '%$keyword%' OR TASK.description LIKE '%$keyword%')";
    }
    if (!empty($category_id)) {
      $sql .= " AND category_id = $category_id";
    }
    if (!empty($status)) {
      $sql .= " AND TASK.status = '$status'";
    }
    if (!empty($dueDate)) {
      $sql .= " AND TASK.due_date <= DATE_ADD(CURRENT_DATE, INTERVAL $dueDate DAY)";
    }

    $offset = ($currentPage - 1) * $itemPerPage;
    $sql .= " LIMIT $offset, $itemPerPage";

    $result = $this->conn->query($sql);
    $tasks = array();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        array_push($tasks, $row);
      }
    }

    return array(
      'totalTasks' => $totalTasks,
      'tasks' => $tasks
    );
  }

  public function closeConnection()
  {
    $this->conn->close();
  }
}