# Task-Tracker-using-CLI
Inspired by: https://roadmap.sh/projects/task-tracker
## Features
- Add a new task: Add a task to your list
- Delete a task: Delete a task from your list
- List tasks by status: View tasks with selected status
- Mark a task as completed: Set a task's status as completed
- Mark a task as in progress: Set a task's status as in progress
- Update a task: Edit the description of an existing task
## Command allowed
1. Adding a new task
```
task-cli add "Buy groceries"
```
2. Updating and deleting tasks
```
task-cli update 1 "Buy groceries and cook dinner"
task-cli delete 1
```
3. Marking a task as in progress or done
```
task-cli list
```
4. Listing tasks by status
```
task-cli list done
task-cli list todo
task-cli list in-progress
```

## Installation
1. Clone the repository to your local
`git clone https://github.com/MpMan123/Task-Tracker-using-CLI.git`
2. Run `run.sh` script
    - Open git bash 
        ```chmod +x run.sh```
        run script
        ```./run.sh```
    - Save alias
        ```~/.bashrc```
3. Now you can push your tasks into your file
    ```task-cli add "Learning English"```
