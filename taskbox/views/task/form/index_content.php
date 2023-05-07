<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>
      <?php echo $action === "add" ? "Add Task" : "Update Task" ?>
    </h1>

    <form id="form-task" method="post" action="">
      <input type="hidden" name="id" id="id" value="<?php echo $task['id']; ?>">

      <div class="mb-3">
        <label for="name" class="form-label">Task Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Task Name">
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Task Description</label>
        <textarea class="form-control" name="description" id="description"
          placeholder="Enter Task Description"></textarea>
      </div>

      <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-control" name="category_id" id="category_id">
          <option value="">Select Category</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="datetime-local" class="form-control" name="start_date" id="start_date"
          placeholder="Select Start Date">
      </div>

      <div class="mb-3">
        <label for="due_date" class="form-label">Due Date</label>
        <input type="datetime-local" class="form-control" name="due_date" id="due_date" placeholder="Select Due Date">
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-block">
          <?php echo $action === "add" ? "Add Task" : "Update Task"; ?>
        </button>
      </div>
    </form>

  </div>
</div>