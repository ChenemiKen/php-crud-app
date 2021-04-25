<?php
     $db_servername = "localhost";
     $db_username = "root";
     $db_password = "";
     $db_name = "crud-app";

     //connection to database
     $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
     // Check connection
     if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     }

     
     ///////////////////////////////////////////////////////////////////////////////
     /* 
          My database is named "crud-app". it has two tables: "users" and "courses"

          users{
               id: int(255), primary-key, auto-increment, unique
               name: varchar(255)
               email: varchar(255), unique
               password: varchar(255)
          }

          courses{
               id: int(255), primary-key, auto-increment, unique
               user: int(255), foreign_key(users(id))
               title: varchar(255)
               content:varchar(255)
               date_created: date
          }
     */
?>