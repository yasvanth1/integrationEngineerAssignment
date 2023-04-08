Intructions:

info: To run this php application follow the instructions below and run the mailerlite-app\sqlFiles\api_key_schema.sql file, 
This will create a connection with mySQL and automatically create a user and a database called mailerliteapp with the credentials being: 

username: root 
Password: rootroot


1: Locate to where the sqlFiles folder is in the project from command prompt, through command cd.

Example: 
C:\Users\examplePath\integrationEngineerAssignment\mailerlite-app\sqlFiles>

2. Copy the path of the api_key_schema.sql file in the project then run the below in VSCode command prompt
   Please specify the correct path for the below statement to work as the below is only an example:

mysql u- p- < C:\Users\examplePath\integrationEngineerAssignment\mailerlite-app\sqlFiles\api_key_schema.sql


3. Run php artisan serve in command prompt of VScode this will start a development server on your local machine


4. all you have to do is search http://localhost:8000/ in any browser to start run the application 