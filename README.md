# Documentation API
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