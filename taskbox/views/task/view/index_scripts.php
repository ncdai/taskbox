<!-- <script src="/public/js/task.update-status.js"></script> -->
<script src="/public/js/jquery.task.update-status.js"></script>

<script>
  $(document).ready(function () {
    $('.js-select-status[data-task-id=<?php echo $task['id']; ?>]').val('<?php echo $task['status']; ?>');
    $('.js-select-status[data-task-id=<?php echo $task['id']; ?>]').attr('data-prev-status', '<?php echo $task['status']; ?>');

    $('#view-task').taskStatus('.js-select-status', '.js-finished-date');
  })
</script>