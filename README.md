# trivias
A clasic trivia game for 1 player

# Demo http://www.davideloper.com/projects/trivias/trivias.php


## About The Project

The game consists on 20 questions about 6 topics(Math, Music, Books, Films, history and General).
At the end you can see your score, time and if you made it to the top 5.


### Built With

* FRONT: HTML,CSS,JAVASCRIPT
* BACK:  LAMP (LINUX,APACHE,PHP,MARIADB)
* SERVICES: DIGITAL OCEAN 



<!-- GETTING STARTED -->
## Getting Started

### Prerequisites

1. You need to have a server with a LAMP stack

### Installation

1. Clone the repo
2. Create a database in your db server with the name trivias
3. Create the following tables on SQL:
   CREATE TABLE users(
    uid int primary key auto_increment,
    name varchar(100) not null unique,
    password varchar(20) not null
   );
   
   CREATE TABLE trivias(
    id int primary key auto_increment,
    userId varchar(100) not null unique,
    score varchar(20) ,
    startTime datetime,
    cat varchar(20) not null,
    time int,
   );
4. Relate the tables by user:
  
   ALTER TABLE trivias ADD FOREIGN KEY (userId) REFERENCES users(uid);
  
 


### Usage Example:

In localhost: 

Go to your browser and enter the link:

localhost/trivias/trivias.php









