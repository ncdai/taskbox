# TaskBox by 18120113

## Install

Clone Source Code

```bash
git clone git@github.com:iamncdai/taskbox.git
cd taskbox
docker-compose up -d
```

Database Configuration
- Access: `http://localhost:8080`
- Login with Username/Password: `root/18120113`
- Create Dabatase: `taskbox`
- Import data from file: `db/taskbox.sql`

The above is the default configuration, you can configure it in the following files:
- `docker-compose.yml`
- `taskbox/config.php`

Congratulations on completing the Website installation, access http://localhost:8000 to use.

## Features

### Task
- List all task with pagination
- Search/Filter tasks by
  - Name or Description
  - Category
  - Status
  - Due Date: 3 days left, 1 week left or 1 month left
- Add task
- Update task
- Quick update status
- Delete tasks

### Category
- Add category
- Update category
- Delete category

## Libs
- jQuery (https://jquery.com/)
- jQuery Validate (https://jqueryvalidation.org/)
- Bootstrap (https://getbootstrap.com/docs/5.3/getting-started/introduction/)
- Toastr (https://codeseven.github.io/toastr/demo.html)
