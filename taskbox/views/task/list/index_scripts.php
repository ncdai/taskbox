<script src="/public/js/jquery.task.update-status.js"></script>
<script>
  $(document).ready(function () {
    <?php foreach ($tasks as $task): ?>
      $('.js-select-status[data-task-id=<?php echo $task['id']; ?>]').val('<?php echo $task['status']; ?>');
      $('.js-select-status[data-task-id=<?php echo $task['id']; ?>]').attr('data-prev-status', '<?php echo $task['status']; ?>');
    <?php endforeach; ?>

    $('#task-list').taskStatus('.js-select-status', '.js-finished-date');

    $('#js-checkbox-all').on('change', function () {
      const isChecked = $(this).prop('checked');
      $('.js-checkbox-task').prop('checked', isChecked);
    });

    $('#js-btn-delete').on('click', function () {
      const selectedRows = $('.js-checkbox-task:checked');

      if (!selectedRows.length) {
        toastr.error('You have not selected any task to delete');
        return;
      }

      if (confirm('Do you want to delete selected tasks?')) {
        const taskIds = [];

        selectedRows.each(function () {
          const taskId = $(this).closest('tr').attr('data-task-id');
          taskIds.push(taskId);
        });

        $.ajax({
          url: '/task/delete-list',
          type: 'POST',
          data: {
            taskIds: taskIds
          },
          success: function (response) {
            console.log(response);
            toastr.success("Tasks have been deleted");
            window.location.reload();
          },
          error: function (xhr, status, error) {
            toastr.error("Failed to delete tasks");
          }
        });
      }
    });

    $("#form-search input[name=keyword]").val('<?php echo $keyword; ?>');
    $("#form-search select[name=category_id]").val('<?php echo $category_id; ?>');
    $("#form-search select[name=status]").val('<?php echo $status; ?>');
    $("#form-search select[name=due_date]").val('<?php echo $due_date; ?>');
  })
</script>