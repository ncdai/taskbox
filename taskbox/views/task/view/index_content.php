<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card" id="view-task">
      <div class="card-body">
        <h5 class="card-title">
          <?php echo $task['name']; ?>
        </h5>
        <p class="card-text">
          <?php echo $task['description']; ?>
        </p>
      </div>

      <ul class="list-group list-group-flush">
        <li class="list-group-item">Category: <strong>
            <?php echo $task['category_name']; ?>
          </strong></li>

        <li class="list-group-item">Start Date: <strong>
            <?php echo $task['start_date']; ?>
          </strong></li>

        <li class="list-group-item">Due Date:
          <strong>
            <?php echo $task['due_date']; ?>
          </strong>
        </li>

        <li class="list-group-item">Finished Date:
          <strong class="js-finished-date" data-task-id="<?php echo $task['id']; ?>">
            <?php echo $task['finished_date'] ? $task['finished_date'] : "---"; ?>
          </strong>
        </li>

        <li class="list-group-item">
          Status:
          <select class="form-select form-select-sm js-select-status" data-task-id="<?php echo $task['id']; ?>"
            style="display: inline-block; width: auto;">
            <option value="TODO">Todo</option>
            <option value="IN_PROGRESS">In Progress</option>
            <option value="FINISHED">Finished</option>
          </select>
        </li>
      </ul>
    </div>
  </div>
</div>