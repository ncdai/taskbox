<?php
require_once 'models/TaskModel.php';
require_once 'helpers/PaginationHelper.php';

class TaskController
{
  private $taskModel;
  private $categoryModel;

  public function __construct()
  {
    $this->taskModel = new TaskModel(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $this->categoryModel = new CategoryModel(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  public function getList($query)
  {
    $currentPage = isset($query['page']) ? $query['page'] : 1;
    $itemPerPage = isset($query['limit']) ? $query['limit'] : ITEM_PER_PAGE;

    $result = $this->taskModel->getTasks($currentPage, $itemPerPage);

    $totalTasks = $result['totalTasks'];
    $tasks = $result['tasks'];
    $categories = $this->categoryModel->getCategories();

    include 'views/task/list/index.php';
  }

  public function getView()
  {
    $id = $_GET['id'];
    $task = $this->taskModel->getTaskById($id);

    include 'views/task/view/index.php';
  }

  public function getForm($queryParams)
  {
    $action = $queryParams['action'];
    $id = $queryParams['id'];

    if (isset($id)) {
      $task = $this->taskModel->getTaskById($id);
    }

    $categories = $this->categoryModel->getCategories();

    include "views/task/form/index.php";
  }

  public function postForm()
  {
    $action = $_GET['action'];

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $start_date = $_POST['start_date'];
    $due_date = $_POST['due_date'];

    if ($action === "add") {
      $result = $this->taskModel->addTask($name, $description, $category_id, $start_date, $due_date);
    } else {
      $result = $this->taskModel->updateTask($id, $name, $description, $category_id, $start_date, $due_date);
    }

    if (!$result) {
      echo json_encode([
        'success' => false,
        'message' => $action === "add"
        ? 'Failed to add task'
        : 'Failed to update task'
      ]);
    } else {
      echo json_encode([
        'success' => true,
        'message' => $action === "add"
        ? 'Task added successfully'
        : 'Task updated successfully'
      ]);
    }
  }

  public function postUpdateStatus()
  {
    $id = $_GET['id'];
    $status = $_POST['status'];

    $result = $this->taskModel->updateTaskStatus($id, $status);

    echo json_encode($result);
  }

  public function postDeleteList()
  {
    $taskIds = $_POST['taskIds'];

    if (empty($taskIds)) {
      echo json_encode(['success' => false, 'message' => 'Please select tasks to delete']);
      return;
    }

    $isDeleted = $this->taskModel->deleteTasks($taskIds);

    if (!$isDeleted) {
      echo json_encode(['success' => false, 'message' => 'Failed to delete tasks']);
      return;
    }

    echo json_encode(['success' => true, 'message' => 'Tasks deleted successfully']);
  }

  public function getSearch()
  {
    $keyword = $_GET['keyword'];
    $category_id = $_GET['category_id'];
    $status = $_GET['status'];
    $due_date = $_GET['due_date'];

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $itemPerPage = isset($_GET['limit']) ? $_GET['limit'] : ITEM_PER_PAGE;

    $result = $this->taskModel->searchTasks($keyword, $category_id, $status, $due_date, $currentPage, $itemPerPage);

    $totalTasks = $result['totalTasks'];
    $tasks = $result['tasks'];
    $categories = $this->categoryModel->getCategories();

    $isFilterMode = true;

    include 'views/task/list/index.php';
  }

  function __destruct()
  {
    $this->taskModel->closeConnection();
  }
}