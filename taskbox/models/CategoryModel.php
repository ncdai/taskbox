<?php

class CategoryModel
{
  private $conn;

  public function __construct($host, $username, $password, $dbname)
  {
    $this->conn = new mysqli($host, $username, $password, $dbname);
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getCategories()
  {
    $sql = "SELECT * FROM CATEGORY";
    $result = $this->conn->query($sql);
    $categories = [];

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
      }
    }

    return $categories;
  }

  public function getCategoryById($categoryId)
  {
    $sql = "SELECT * FROM CATEGORY WHERE id = $categoryId";
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
      $category = $result->fetch_assoc();
    } else {
      $category = [];
    }

    return $category;
  }

  public function addCategory($name)
  {
    $dateCreated = date('Y-m-d H:i:s');

    $stmt = $this->conn->prepare("INSERT INTO CATEGORY (name, date_created) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $dateCreated);

    $result = $stmt->execute();

    return $result ? true : false;
  }

  public function updateCategory($id, $name)
  {
    $stmt = $this->conn->prepare("UPDATE CATEGORY SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $name, $id);

    $result = $stmt->execute();

    return $result ? true : false;
  }

  public function deleteCategory($categoryId)
  {
    $query = "DELETE FROM CATEGORY WHERE id = $categoryId";
    $result = $this->conn->query($query);

    if ($result) {
      return true;
    }

    if ($this->conn->errno == 1451) {
      // Foreign key violation error
      return "Cannot delete the category. It is associated with one or more tasks.";
    }

    // Other error
    return "An error occurred while deleting the category: " . $this->conn->error;
  }

  public function closeConnection()
  {
    $this->conn->close();
  }
}