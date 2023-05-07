<script>
  $(document).ready(function () {
    <?php if ($action === "update"): ?>
      $("#name").val("<?php echo $task['name']; ?>");
      $("#description").val("<?php echo $task['description']; ?>");
      $("#category_id").val("<?php echo $task['category_id']; ?>");
      $("#start_date").val("<?php echo $task['start_date']; ?>");
      $("#due_date").val("<?php echo $task['due_date']; ?>");
    <?php endif; ?>

    $.validator.addMethod("greaterThanStart", function (value, element) {
      var startValue = $("#start_date").val();
      var dueValue = value;

      if (startValue && dueValue) {
        var startDate = new Date(startValue);
        var dueDate = new Date(dueValue);

        return dueDate > startDate;
      }

      return true;
    }, "Due date must be after start date");

    $("#form-task").validate({
      rules: {
        name: {
          required: true,
          minlength: 3
        },
        description: {
          required: true,
          minlength: 3
        },
        category_id: {
          required: true
        },
        start_date: {
          required: true
        },
        due_date: {
          required: true,
          greaterThanStart: true
        }
      },
      messages: {
        name: {
          required: "Please enter a name",
          minlength: "Name must be at least 3 characters"
        },
        description: {
          required: "Please enter a description",
          minlength: "Description must be at least 3 characters"
        },
        category_id: {
          required: "Please select a category"
        },
        start_date: {
          required: "Please enter a start date"
        },
        due_date: {
          required: "Please enter a due date",
          greaterThanStart: "Due date must be after start date"
        }
      },
      submitHandler: function (form) {
        $.ajax({
          url: "/task/form?action=<?php echo $action; ?>",
          type: "POST",
          data: $(form).serialize(),
          success: function (response) {
            console.log("Form submitted successfully!", response);
            alert("Form submitted successfully!");
            window.location.href = "/task";
          },
          error: function (xhr, status, error) {
            console.log("Form submission error:", error);
            toastr.error("Form submission error!");
          }
        });
      }
    });
  })
</script>