# P4 --Task Manager

## Author: Muhammad Kaleem Abdullah

## Description

This is my fourth and final project (P4) for the course CSCI E-15 Dynamic Web Applications. This project is a web application, called "Task Manager". This web application is used for tracking the status of tasks assigned to different team members in a project. Here are the main features:

1. Allow two different types of users -- ADMIN and MEMBER.
2. The ADMIN users can create tasks and assign them to other users (including themselves).
3. Displaying all the tasks assigned to user on the main page.
4. Option to display COMPLETED tasks.
5. Option to display INCOMPLETE tasks.
6. Allowing the user the modify a task, including the task status.

## Program Logic

It is a Laravel framework based web side and it follows "separation of concerns" design principle.

It is using two controllers:

1. TaskController.php
		This controller provides methods to list, add, and modify tasks.
2. AuthController.php
    This controller is created as part of Laravel's built-in authentication mechanism but I have modified it so that it can handle extra column for user role.

There are 3 task related views:

1. task.create -- view to create a new task
2. task.edit -- view to edit a task
3. task.list -- view to list tasks


## Project Planning

Here is a link to project planning document [Link](https://docs.google.com/document/d/1EjofPJ_pHRT3e1gr1JDJP7qSW2_X2DjeRurrMyL32WM/edit).

## Where is it?

Project [Link](http://p4.kaleemabdullah.com).
Project code is available at [Github](https://github.com/mkabdullah/p4)

## Project Demo

The project demo video is hosted [here](https://www.youtube.com/watch?v=pb3ijxObTjs)

## Credits

The project uses the following external css files:

1. https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css
2. https://fonts.googleapis.com/css?family=Lato:100,300,400,700
3. https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css
