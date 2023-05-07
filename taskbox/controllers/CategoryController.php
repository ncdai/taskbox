<?php
require_once 'models/CategoryModel.php';

class CategoryController
{
  private $categoryModel;

  public function __construct()
  {
    $this->categoryModel = new CategoryModel(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  }

  public function getList()
  {
    $categories = $this->categoryModel->getCategories();
    include 'views/category/list/index.php';
  }

  public function getForm($queryParams)
  {
    $action = $queryParams['action'];
    $id = $queryParams['id'];

    if (isset($id)) {
      $category = $this->categoryModel->getCategoryById($id);
    }

    include "views/category/form/index.php";
  }

  public function postForm()
  {
    $action = $_GET['action'];

    $id = $_POST['id'];
    $name = $_POST['name'];

    if ($action === "add") {
      $result = $this->categoryModel->addCategory($name);
    } else {
      $result = $this->categoryModel->updateCategory($id, $name);
    }

    if (!$result) {
      echo json_encode([
        'success' => false,
        'message' => $action === "add"
        ? 'Failed to add category'
        : 'Failed to update category'
      ]);
    } else {
      echo json_encode([
        'success' => true,
        'message' => $action === "add"
        ? 'Category added successfully'
        : 'Category updated successfully'
      ]);
    }
  }

  public function getDelete()
  {
    $id = $_GET['id'];

    $result = $this->categoryModel->deleteCategory($id);
    $hasError = $result === true ? false : true;
    if ($hasError) {
      $errorMessage = $result;
    }

    include 'views/category/delete/index.php';
  }

  function __destruct()
  {
    $this->categoryModel->closeConnection();
  }
}