# instruct-eric-task

1. Clone the repository by running `git clone https://github.com/BaiRado/instruct-eric-task.git`
2. To start the docker service run `docker-compose up` in the local repository folder
3. After it completes go to localhost on port 8080 http://localhost:8080/ and it should display "Services running"
4. To add the data to the database go to phpmyadmin on port 8081 http://localhost:8081/ and log in. The username is 'root' and the password can be found in the docker-compose.yml file. Simply import the services.csv file into `instruct-eric-task-db`
5. You can run the CLI by going into the /src folder and running `php api-cli.php`

P.S.: There were issues with this repository being private, so I have made it public for now
