# Documentation API

## Domain:

**Base Url**: : http://five.cyril-vinikoff.fr/app_dev.php/

**Backoffice**: : http://five.cyril-vinikoff.fr/app_dev.php/admin/dashboard

## Sommaire:

🔑 [Authentication](#auth)

😎 [Users](#users)

⚽️ [Game](#match)


<a id="auth"></a>
## Authentication

- **Connexion :** POST `/api/signIn` :
	- Body de la requête de connexion :
	```
	{
		"username": [username du user],
		"password": [password du user]
	}
	```
	- Exemple de la réponse (JSON) :
    ```
    {

        "userKey": "cg88qLM3VCS5P2IarMbqfBiC5yqBQzrc3H-Esiy_FSQ",
        "expires": "2019-04-27T14:37:16+02:00"

    }
    ```
- **Inscription :** POST `/api/signUp` :
	- Body de la requête d'inscription :
	```
	{
		"username"          : [username du user],
		"password"          : [password du user],
		"email"             : [email du user],
		"birth"             : [date de naissance du user]
		"regularityPlayer"  : [régularité de jeu du user]
		"userCity"          : [ville du joueur]
		"picture"           : [photo du joueur]
	}
	```
	- Exemple de la réponse (JSON) :
    ```
    {

        "userKey": "M3mB_RpnEertNTJswr_v0oiI_EP7YztSHA3vPo9b0Ls",
        "expires": "2019-04-27T15:58:09+02:00"

    }
   ```
   
<a id="match"></a>
## Game

- **Liste des matchs :** POST `/api/listMatch` :
	- Body de la requête pour lister les matchs :
	```
	{
		"id":                [id du match],
		"name":              [username du match],
		"town":              [town du match]
		"date":              [date du match]
		"nbr_max_players":   [nbr_max_players de joueur pour le match]
		"organisator":       [username de l'organisateur]
        "users":             [username des joueurs associés ]
	}
	```
	- Exemple de la réponse (JSON) :
    ```
    [
        {
            "id": 1,
            "name": "Game5",
            "town": "Ivry sur Seine",
            "date": "2019-05-01T00:00:00+02:00",
            "nbr_max_players": 10,
            "organisator": {
                "username": "ben"
            },
            "users": [
                {
                    "username": "Ben"
                },
                {
                    "username": "Abraham"
                },
                {
                    "username": "Max"
                },
                {
                    "username": "Wes"
                },
                {
                    "username": "Adaane"
                },
                {
                    "username": "Samy"
                },
                {
                    "username": "Cyril"
                },
                {
                    "username": "Julien"
                },
                {
                    "username": "Rocco"
                },
                {
                    "username": "Seb"
                }
            ]
        },
        {
            "id": 2,
            "name": "Game5",
            "town": "Ivry sur Seine",
            "date": "2019-05-03T00:00:00+02:00",
            "nbr_max_players": 0,
            "users": []
        }
    ]
    ```