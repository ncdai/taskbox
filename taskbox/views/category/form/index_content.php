<div class="row">
  <div class="col-md-6 offset-md-3">
    <h1>
      <?php echo $action === "add" ? "Add Category" : "Update Category" ?>
    </h1>

    <form id="form-category" method="get" action="">
      <input type="hidden" name="id" id="id" value="<?php echo $category['id']; ?>">

      <div class="mb-3">
        <label for="name" class="form-label">Category Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name">
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">
          <?php echo $action === "add" ? "Add Category" : "Update Category"; ?>
        </button>
      </div>
    </form>
  </div>
</div>