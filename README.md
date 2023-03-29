# Manage-account-Php-JQuery
In this project you are gonna find these files: 
1. connexion.php -> This file I use it just to connect with database 
2. database_and_tables.php -> This file is use it to create database and tables. You can run this file with the command in your console "php database_and_tables.php".
Although, this file has a function witch is possible to call it from "manage_data.php" file.
3. manjage_data.php -> This file is use it to Create, Insert, Select and Delete datas from database. This file use a loop "switch" to do all the requirements. 

4. manage_data.js -> This file is use it to send and receive the requirements with JQuery to the "database_and_tables.php" file. It has differents functions, filter, insert, and remove. 
At the beginning we apply a function JQuery-> $(document).ready(function () {} ) to get the initial data with ajax- > $.ajax({ }) Selecting initial data.
Other functions: 
Filter()-> filter the data with Jquery.
Remove()-> remove data s3ending to php
Insert()-> Insert data sending to php 

5. index.html -> I present the data in this file and it has 3 buttons to trigger the functions filter(), remove() and Insert


#Start the application
![Beginning of the app](https://user-images.githubusercontent.com/38941153/228503483-ca2a78ae-d011-441e-a4ab-057398fae4e1.png)
#Inserting data
![inserting data](https://user-images.githubusercontent.com/38941153/228503616-9a30ac0a-0c8b-4287-92d9-17d40679e386.png)
#Filtering by id -> it has two filters
![filtering by id 1](https://user-images.githubusercontent.com/38941153/228503999-07011ad8-6a4e-4e10-8f60-1819d4322228.png)
#Removing data
![Removing data](https://user-images.githubusercontent.com/38941153/228504155-40bd28fb-e2a5-41ef-a4b2-61b02454256e.png)

