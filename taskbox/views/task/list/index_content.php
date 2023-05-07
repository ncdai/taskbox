<div class="d-flex align-items-center">
  <h1>My Tasks</h1>
  <a href="/task/form?action=add" class="btn btn-primary ms-3">Add Task</a>
</div>

<form class="row gy-2 gx-2 align-items-center mt-3 mb-4" action="/task/search" id="form-search">
  <div class="col-sm-3">
    <input class="form-control" type="search" name="keyword" placeholder="Search by Name, Description">
  </div>

  <div class="col-sm-2">
    <select class="form-select" name="category_id">
      <option value="">Category</option>
      <?php foreach ($categories as $category): ?>
        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-sm-2">
    <select class="form-select" name="status">
      <option value="">Status</option>
      <option value="TODO">Todo</option>
      <option value="IN_PROGRESS">In Progress</option>
      <option value="FINISHED">Finished</option>
    </select>
  </div>

  <div class="col-sm-2">
    <select class="form-select" name="due_date">
      <option value="">Due Date</option>
      <option value="3">3 Days Left</option>
      <option value="7">1 Week Left</option>
      <option value="30">1 Month Left</option>
    </select>
  </div>

  <div class="col-auto">
    <button type="submit" class="btn btn-primary">Search</button>
  </div>

  <?php if (isset($isFilterMode)): ?>
    <div class="col-auto">
      <a href="/task" class="btn btn-outline-danger">Clear Filter</a>
    </div>
  <?php endif; ?>
</form>

<table class="table table-bordered align-middle table-hover" id="task-list">
  <thead class="table-light">
    <tr>
      <th scope="col" class="text-center">
        <input class="form-check-input" type="checkbox" id="js-checkbox-all">
      </th>
      <th scope="col" class="text-center">Name</th>
      <th scope="col" class="text-center">Category</th>
      <th scope="col" class="text-center">Due Date</th>
      <th scope="col" class="text-center">Finished Date</th>
      <th scope="col" class="text-center">Status</th>
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>

  <tbody class="table-group-divider">
    <?php foreach ($tasks as $task): ?>
      <tr data-task-id="<?php echo $task['id']; ?>">
        <td class="text-center" width="40">
          <input class="form-check-input js-checkbox-task" type="checkbox">
        </td>
        <td>
          <a href="/task/view?id=<?php echo $task['id']; ?>"><?php echo $task['name']; ?></a>
        </td>
        <td>
          <?php echo $task['category_name']; ?>
        </td>
        <td width="200" class="text-center">
          <?php echo $task['due_date']; ?>
        </td>
        <td width="200" class="text-center">
          <span class="js-finished-date" data-task-id="<?php echo $task['id']; ?>">
            <?php echo $task['finished_date'] ? $task['finished_date'] : "---"; ?>
          </span>
        </td>

        <td width="160">
          <select class="form-select form-select-sm js-select-status" data-task-id="<?php echo $task['id']; ?>">
            <option value="TODO">Todo</option>
            <option value="IN_PROGRESS">In Progress</option>
            <option value="FINISHED">Finished</option>
          </select>
        </td>

        <td width="160" class="text-center">
          <a href="/task/form?action=update&id=<?php echo $task['id']; ?>"
            class="btn btn-outline-secondary btn-sm">Update</a>
          <a href="/task/view?id=<?php echo $task['id']; ?>" class="btn btn-outline-primary btn-sm">View</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>

  <tfoot>
    <tr>
      <td colspan="7">
        <div class="d-flex align-items-center gap-2">
          <span class="text-secondary">Select tasks to delete</span>
          <button type="button" class="btn btn-outline-danger" id="js-btn-delete">Delete</button>
        </div>
      </td>
    </tr>
  </tfoot>
</table>

<?php
$currentUrl = PaginationHelper::getCurrentUrl();

$paginationData = PaginationHelper::getPaginationData($totalTasks, $itemPerPage, $currentPage);
$totalPages = $paginationData['totalPages'];
$prevPage = $paginationData['prevPage'];
$nextPage = $paginationData['nextPage'];
?>

<nav>
  <ul class="pagination justify-content-center pagination-default">
    <li class="page-item">
      <a class="page-link" href="<?php echo PaginationHelper::getPageLink($currentUrl, $prevPage, $itemPerPage); ?>">
        <span>&laquo;</span>
      </a>
    </li>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <li class="page-item <?php echo $currentPage == $i ? "active" : ""; ?>">
        <a class="page-link" href="<?php echo PaginationHelper::getPageLink($currentUrl, $i, $itemPerPage); ?>"><?php echo $i; ?></a>
      </li>
    <?php endfor; ?>

    <li class="page-item">
      <a class="page-link" href="<?php echo PaginationHelper::getPageLink($currentUrl, $nextPage, $itemPerPage); ?>">
        <span>&raquo;</span>
      </a>
    </li>
  </ul>
</nav>