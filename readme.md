# Bowling Game 
A program for a ten-pin bowling game which calcuates the score for a given frames input.

## Technologies Used
* PHP 7.2
* Laravel Framework 5.7.3
* Composer as package manager

## Prerequisites

Make sure that **PHP**, **Git** and **Composer package manager** is already installed on the system. If not then follow the instructions to download and install all of these dependencies from the below links
* [PHP](http://php.net/manual/en/install.php)
* [Git](https://git-scm.com/downloads)
* [Composer package manager](https://getcomposer.org/)


## Installation
The installation process is quite simple and straightforward. Just follow the below steps
 
- Open the terminal and navigate into the root directory of the web server and then execute the below command to download the code from github
```
git clone https://github.com/waqasrazaq/bowling-game.git
```
- Once the code is downloaded then navigate into project directory (bowling-game) and execute the below command in the root directory and wait for the process to download and install all the required components and dependencies

```composer install```

It will take some time, so wait for a couple of minutes to complete the process.

## Example
Open terminal, navigate to the project directory and execute the below command
``` php artisan game-input:frames "[[5,2],[8,1],[6,4],[10],[0,5],[2,6],[8,1],[5,3],[6,1],[10,2,6]]" ```

## Tests
Open terminal, navigate to the project directory and execute the below command
``` vendor/bin/phpunit ```


