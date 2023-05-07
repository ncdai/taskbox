<?php if ($hasError): ?>
  <div class="alert alert-danger" role="alert">
    <?php echo $errorMessage; ?>
    <a href="/category" class="alert-link">Go back</a>
  </div>
<?php else: ?>
  <div class="alert alert-success" role="alert">
    Category deleted successfully!
    <a href="/category" class="alert-link">Go back</a>
  </div>
<?php endif; ?>