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

if we can get the last match for the player's club, we can hit that endpoint and display those stats
