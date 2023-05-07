<?php

require_once 'config.php';

require_once 'controllers/CategoryController.php';
require_once 'controllers/TaskController.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$router = [
  'GET' => [
    // Home
    '/' => 'TaskController@getList',

    // Category
    '/category' => 'CategoryController@getList',
    '/category/form' => 'CategoryController@getForm',
    '/category/delete' => 'CategoryController@getDelete',

    // Task
    '/task' => 'TaskController@getList',
    '/task/search' => 'TaskController@getSearch',
    '/task/form' => 'TaskController@getForm',
    '/task/view' => 'TaskController@getView'
  ],
  'POST' => [
    // Category
    '/category/form' => 'CategoryController@postForm',

    // Task
    '/task/form' => 'TaskController@postForm',
    '/task/update-status' => 'TaskController@postUpdateStatus',
    '/task/delete-list' => 'TaskController@postDeleteList'
  ]
];

// Phân tích URL và truy xuất tham số query
$uriParts = parse_url($requestUri);
$path = $uriParts['path'];
$query = isset($uriParts['query']) ? $uriParts['query'] : '';

if (isset($router[$requestMethod])) {
  $routes = $router[$requestMethod];
  foreach ($routes as $route => $action) {
    if ($path === $route) {
      [$controllerName, $methodName] = explode('@', $action);

      // Phân tích và truyền các tham số query vào phương thức
      parse_str($query, $queryParams);

      $controller = new $controllerName();
      $controller->$methodName($queryParams);

      exit();
    }
  }
}

// Nếu không tìm thấy route phù hợp
http_response_code(404);

$content = 'views/404.php';
include 'views/layout.php';

?>
