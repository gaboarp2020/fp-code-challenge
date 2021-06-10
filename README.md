# FP Code Challenge

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

This Code Challenge consists of creating an Application with a login page in which a user can authenticate with a digital certificate. This certificate was provided for the purposes of this challenge and was added in the browser.

*note: A configured web server is required for this.

The application must have: 

 - A database of my choice 
 - Be able to implement via dockerfile
 - Use the docker image [firmaprofesional/code-challenge](https://hub.docker.com/r/firmaprofesional/code-challenge). 

It also had to be created using PHP 7.2 and Symfony as Framework.

## Technical Choices
### PHP y Symfony
As mentioned, to develop the application I had to implement Symfony 4 as Framework and PHP 7.2 

### Database
For the database, the Docker image postgreSQL v13 (in alpine) was implemented. Probably MySQL or any other database would also be great options. However, PostSQL is a robust open source database and I have more experience using it as well. 

As it's a simple single entity application, where an ACID transactions is not required ... there is nothing special in this choice.

### Architecture
In this project, an architecture based on this [architecture file descrition](https://github.com/firmaprofesional/code-challenge/blob/main/core-team/DefaultArchitecture.pdf) was implemented.

### What can be improved
The controllers have some complicated logic. It would probably have been better to delegate that logic to other services.

On the other hand, it would have been much better if automated tests had been created with tools such as PHPUnit or Behat. I had difficulty configuring unit tests implementing the required folder structure for the project and using Symfony. I think it took me a little more time to learn how to do it effectively 

## Project setup
Once the repository is cloned, run the following commands in the repo directory:
```
bash setup.sh
```
*note: A bash terminal is required. However, you can manually perform the processes in the setup.sh file.

### Init the project
```
bash init.sh
```
*note: This should only be run once.

### php bin/console
Once the containers are running you can run php console/bin with:
```
docker-compose exec php_app php bin/console
```
Author: Gabriel Ron


### Customize configuration
See [Configuration Reference](https://symfony.com/doc/4.4/setup.html).
