<div class="d-flex align-items-center">
  <h1>Categories</h1>
  <a href="/category/form?action=add" class="btn btn-primary ms-3">Add Category</a>
</div>

<table class="table table-bordered align-middle table-hover">
  <thead class="table-light">
    <tr>
      <th scope="col" class="text-center">Category Name</th>
      <th scope="col" class="text-center">Created Date</th>
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <?php foreach ($categories as $category): ?>
      <tr>
        <td>
          <?php echo $category['name']; ?>
        </td>
        <td width="200" class="text-center">
          <?php echo $category['date_created']; ?>
        </td>
        <td width="160" class="text-center">
          <a href="/category/form?action=update&id=<?php echo $category['id']; ?>" class="btn btn-outline-primary btn-sm">Update</a>
          <a href="/category/delete?id=<?php echo $category['id']; ?>" class="btn btn-outline-danger btn-sm">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>