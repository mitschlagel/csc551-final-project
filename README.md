# csc551-final-project

## api-football documentation

[https://www.api-football.com/documentation-v3](https://www.api-football.com/documentation-v3)

## api-football league IDs

- UEFA Champions League: **2**
- UEFA Europa League: **3**
- Spain La Liga: **140**
- France Ligue 1: **61**
- England Premier League: **39**
- Germany Bundesliga: **78**
- Italy Serie A: **135**

## player stats endpoint

player endpoint is [https://v3.football.api-sports.io/players](https://v3.football.api-sports.io/players)
requires the season and league param to search for a player name

## notes for updating stats

api-football has an endpoint for stats from the last match ---
[https://v3.football.api-sports.io/fixtures/players](https://v3.football.api-sports.io/fixtures/players)

we have to get the team ID for the player, then send request to /fixtures endpoint to get the last fixture id, then send fixture id and team id to fixtures/players, and parse that JSON response for the data for the specific player we are searching for.... oh my.

## ideas

can we store fav players in localStorage? nope because a cache refresh could wipe this out.

## table schema

Table: User Info

- user id number (primary key)
- user name
- password
- first name
- last name
- email
- country
- registration date

Table: User Favorite Players

- user id number (foreign key)
- player id

Table: Player Stats (should be updated with each call to api)

- player id (primary key)
- minutes
- last match id
