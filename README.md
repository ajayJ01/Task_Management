# Task Management

## Description
This is a simple task management system

## Requirements
- PHP
- Composer
- Laravel
- MySQL

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/ajayJ01/Task_Management.git
2. composer install
3. rename the file `.env.example` to `.env`
4. run command : 
    - php artisan key:generate
    - php artisan migrate
    - php artisan db:seed
    - php artisan serve

- `You can get the login credentials in seeder DatabaseSeeder`    

## API Documentation

1. List Tasks
- Endpoint: GET /api/tasks
- Response:
     {
        "message":
            "Tasks fetched successfully!",
            "data": [ ... ]
    }


2. Detail of Tasks
- Endpoint: GET /api/tasks/taskId
- Response:
            {
                "message": "Task retrieved successfully!",
                "data": {
                    "id": 3,
                    "title": "title 2",
                    "description": "description 2",
                    "status": "completed",
                    "user_id": 1,
                    "category_id": 2,
                    "created_at": "2024-10-20T10:36:26.000000Z",
                    "updated_at": "2024-10-20T12:28:00.000000Z",
                    "attachment": null
                }
            }

3. Create Tasks
- Endpoint: POST /api/tasks
- Request Body:
        {
            title:title 4
            description:description 4
            category_id:1
            user_id:1
            status:pending
        }
- Response:
       {
            "message": "Task created successfully!",
            "task": {
                "title": "title 4",
                "description": "description 4",
                "status": "pending",
                "category_id": "1",
                "user_id": "1",
                "attachment": "attachments/c1wmKWvRpVuXINEyZqa7PZatGXk4V9hJmAolXlpG.jpg",
                "updated_at": "2024-10-20T13:05:51.000000Z",
                "created_at": "2024-10-20T13:05:51.000000Z",
                "id": 8
            }
        }   

4. Update Task
- Endpoint: PUT /api/tasks/{id}
- Request Body: 
            {
                "title": "Updated title",
                "status": "completed",
                "category_id": 1
            }
- response : 
            {
                "message": "Task updated successfully!",
                "task": { ... }
            }

5. Delete Task
- Endpoint: DELETE /api/tasks/{id}
- Response: 
            {
                "message": "Task deleted successfully!"
            }
             

