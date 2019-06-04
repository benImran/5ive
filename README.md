# Documentation API

## Domain:

**Base Url**: : http://five.cyril-vinikoff.fr

**Backoffice**: : http://five.cyril-vinikoff.fr/admin/dashboard

## Sommaire:

🔑 [Authentication](#auth)

⚽️ [Game](#match)

🏋🏽‍♂️ [Niveau](#level)

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
            ],
            "rate": [
                        {
                            "id": 107,
                            "is_vote": false,
                            "users": {
                                "id": 97,
                                "username": "testclem2",
                                "level": {
                                    "count_match": 1,
                                    "count_yellow_card": 2,
                                    "count_red_card": 1,
                                    "attaque": 3,
                                    "defense": 2,
                                    "gardien": 1
                                },
                                "regularity_players": ""
                            }
                        },
                        {
                            "id": 113,
                            "is_vote": false,
                            "users": {
                                "id": 97,
                                "username": "testclem2",
                                "level": {
                                    "count_match": 1,
                                    "count_yellow_card": 2,
                                    "count_red_card": 1,
                                    "attaque": 3,
                                    "defense": 2,
                                    "gardien": 1
                                },
                                "regularity_players": ""
                            }
                        },
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
    
- **Création des matchs :** POST `/api/newMatch` :
	- Body de la requête pour créer les matchs :
	```
	```
    - Exemple de la réponse (JSON) :
    ```
	{
        "id": 29,
        "name": "test",
        "town": "Marseille",
        "date": "2019-05-16T00:00:00+02:00",
        "nbr_max_players": 10,
        "organisator": {
            "id": 31,
            "username": "Seb_SRFC",
            "level": {
                "count_match": 2,
                "rank": {
                    "name": "Debutant"
                },
                "count_yellow_card": 2,
                "count_red_card": 2,
                "attaque": 13,
                "defense": 6,
                "gardien": 4
            },
            "regularity_players": ""
        },
        "is_end": true,
        "users": [
            {
                "id": 31,
                "username": "Seb_SRFC",
                "level": {
                    "count_match": 2,
                    "rank": {
                        "name": "Debutant"
                    },
                    "count_yellow_card": 2,
                    "count_red_card": 2,
                    "attaque": 13,
                    "defense": 6,
                    "gardien": 4
                },
                "regularity_players": ""
            }
        ]
    }
	
    ```
    
- **Rejoindre des matchs :** POST `/api/newMatch` :
	- Body de la requête pour créer les matchs :
	```
	
	```
    - Exemple de la réponse (JSON) :
    ```
	{
        "id": 22,
        "name": "TestOrganisator",
        "town": "Lyon",
        "date": "2019-10-06T18:00:00+02:00",
        "nbr_max_players": 11,
        "organisator": {
            "id": 34,
            "username": "Dudu",
            "level": {
                "count_match": 2,
                "rank": {
                    "name": "Debutant"
                },
                "count_yellow_card": 0,
                "count_red_card": 0,
                "attaque": 0,
                "defense": 0,
                "gardien": 0
            },
            "regularity_players": ""
        },
        "is_end": false,
        "users": [
            {
                "id": 31,
                "username": "Seb_SRFC",
                "level": {
                    "count_match": 2,
                    "rank": {
                        "name": "Debutant"
                    },
                    "count_yellow_card": 2,
                    "count_red_card": 2,
                    "attaque": 13,
                    "defense": 6,
                    "gardien": 4
                },
                "regularity_players": ""
            }
        ],
        "rate": [
            {
                "id": 145,
                "is_vote": false,
                "users": {
                    "id": 31,
                    "username": "Seb_SRFC",
                    "level": {
                        "count_match": 2,
                        "rank": {
                            "name": "Debutant"
                        },
                        "count_yellow_card": 2,
                        "count_red_card": 2,
                        "attaque": 13,
                        "defense": 6,
                        "gardien": 4
                    },
                    "regularity_players": ""
                }
            }
        ]
    }
<a id="level"></a>
## Level
- **Niveau par joueur :** POST `/api/profilLevel` :
	- Body de la requête pour voir le niveau par joueur :
	```
	{
        "username":          [username du joueur],
        "level": {
                             [count_level du joueur],
                             [degree_expe du joueur],
                             [degree_exp_max du joueur],
                             [rank du joueur],
                             [count_yellow_card du joueur],
                             [count_red_card du joueur],
                
        }
        
    }
    ```
    - Exemple de la réponse (JSON) :
    
    ```
    {
        "username": "ben",
        "level": {
            "count_level": 3,
            "degree_expe": 30,
            "degree_exp_max": 1800,
            "rank": "Semi-Pro",
            "count_yellow_card": 0,
            "count_red_card": 0
        }
    }
    
    ```