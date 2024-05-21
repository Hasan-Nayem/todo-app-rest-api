
# RESTful API for a To-Do List Application
**Description**

This Laravel-based To-Do List Application is a simple yet powerful tool designed to help users manage their tasks efficiently. The application supports creating, reading, updating, and deleting (CRUD) tasks, making it easy to organize and keep track of your to-dos.






## Features

- Task Management: Add, view, update, and delete tasks.
- Task Details: Each task includes a title, description, and completion status.
- Validation: Ensures that task titles are not empty upon creation or update.
- API Endpoints: RESTful API endpoints for managing tasks programmatically.
- Database Migration: Seamless database setup with Laravel migrations.
- Unit Testing: Comprehensive test cases to ensure the reliability of the application.


## Features

- **Backend:**  Laravel
- **Database:**  MySQL (or SQLite for testing)
- **Testing:** PHPUnit for unit and feature tests




## Installation and Setup

Clone the Repository

```bash
  git clone https://github.com/Hasan-Nayem/todo-app-rest-api.git
```
Enter the project file
```bash
  cd todo-app-rest-api
```

Install Dependencies:

```bash
  composer install
  npm install
  npm run dev
```

Environment Configuration:

```bash
  cp .env.example .env
  or
  copy .env.example .env
```

Generate Application Key:

```bash
  php artisan key:generate
```

Then create a database named todo_app and paste the database name in .env file

```bash
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=todo_app
  DB_USERNAME=root
  DB_PASSWORD=
```

Run Migrations:

```bash
  php artisan migrate
```

Serve the application

```bash
  php artisan serve
```

## API Endpoints

#### Create task

```http
  POST /api/tasks
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `title` | `string` | **Required** |
| `description` | `string` | **Required** |


#### Sample Response

```json
{
    "acknowledge": true,
    "insertedId": 1
}
```

#### Get all tasks

```http
  GET /api/tasks
```

#### Sample Response

```json
{
    "tasks": [
        {
            "id": 1,
            "title": "Task Title",
            "description": "Task description",
            "is_completed": 0,
            "created_at": "2024-05-21T14:57:43.000000Z",
            "updated_at": "2024-05-21T14:57:43.000000Z"
        },
        {
            "id": 2,
            "title": "Test Title",
            "description": "Test description",
            "is_completed": 0,
            "created_at": "2024-05-21T14:57:43.000000Z",
            "updated_at": "2024-05-21T14:57:43.000000Z"
        }
    ]
}
```

#### View Task

```http
  GET /api/tasks/{id}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id` | `integer` | **Required** |

#### Sample Response

```json
{ "task": 
    { 
        "id": 1, 
        "title": "Task Title", 
        "description": "Task Description", 
        "is_completed": false 
    } 
}
```

#### Update Task

```http
  PUT /api/tasks/{id}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id` | `integer` | **Required** |
| `title` | `string` | **Required** |
| `description` | `string` | **Required** |
| `is_confirmed` | `bool` | **Optional** |

#### Sample Response

```json
{
    "message": "Task updated successfully",
    "task": {
        "title": "Doing home work",
        "description": "Have to finish this homework before 12:00 AM",
        "is_completed": false
    }
}
```
#### Delete Task

```http
  DELETE /api/tasks/{id}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id` | `integer` | **Required** |

#### Sample Response

```json
{ 
    "message": "Task deleted successfully" 
}
```
## Running Tests

To run tests, run the following command

```bash
    php artisan test
```

