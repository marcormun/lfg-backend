
# LFG Discord-based with Laravel

This project was created to make a Discord-based LFG service with Laravel. It is a simple, easy-to-use, and easy-to-maintain LFG service. You can create users, parties and send messages.


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Contents

- [Basics](#how-to-use-it)
- [Endpoints](#endpoints)
    - [Auth](#auth)
    - [Party](#party)
    - [Message](#message)
    - [Game](#game)
- [BBDD](#bbdd)
- [Author](#author)





# Basics

The project is deployed on heroku, you have to aim to the following  [link](https://discordlfg.herokuapp.com/api).
Then you can try the following endpoints through postman:





# Endpoints


### Auth

POST /register --> Register a new user

POST /login --> Login a user

GET /me  --> See your profile

GET /logout --> Logout a user


### Party

GET /parties --> See all parties

GET /parties/:id --> See a party

GET /parties/game/:id --> See all parties by game

POST /parties --> Create a party

PUT /parties/:id --> Update a party

DELETE /parties/:id --> Delete a party

POST /parties/joinParty/:id --> Make a user join a party

DELETE /parties/joinParty/:id --> Make a user leave a party

### Message

GET /messages/party/:id --> See all messages from a party

POST /messages --> Create a message

PUT /messages/:id --> Update a message

DELETE /messages/:id --> Delete a message

### Game

GET /games --> See all games

GET /games/:id --> See a game

POST /games --> Create a game

PUT /games/:id --> Update a game

DELETE /games/:id --> Delete a game

# BBDD

![image](https://user-images.githubusercontent.com/102702041/182958166-3f57c789-119a-45de-8e0f-55da5350f344.png)


# Author

[Marc Cordón Muñoz](https://tinyurl.com/marcormun)

---------------------

[:top:](#contents)
