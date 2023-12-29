# Secure_newsportal_project
with prevention of sql injections by 
1) stored procedures
2) prepared statements
3) input sanitization

creation of session variables
1)to implement access control via preventing url access of content

Built using HTML,CSS,PHP
for ubuntu or any linux based os users follow below 
need to install XAMPP
need to place newsportal folder in /opt/lampp/htdocs
give necessary permission by sudo chown $USER:$USER newsportal
open xampp
start mysql database in GUI
start apache server in GUI
open browser and type 
localhost/dashboard
and localhost/phpmyadmin
create new database called "news" not by any other name
import the .sql file provided 
now open in browser localhost/news/admin.php
