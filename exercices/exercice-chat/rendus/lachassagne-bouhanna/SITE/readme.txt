Travail à rendre en PhP :

			Réaliser un chat en PhP avec Ajax.
	
		Rendu :

	Le travail effectué est une experience, elle n'est donc pas fournis en contenu
et contient du Lorem Ipsum.
	Features réalisées : 	
				- Système register/login.
				- Possibilité de créations de salles de chat.
				- Management de compte lié avec page "mon compte" et
				  possibilité de supprimer les chats créés.
				- Chat en Ajax sous formes de bulles (un petit peu
				  typé Iphone) avec nom de l'envoyeur et date/heure.
	Features prévues (non réalisées pour cause de temps) :
				- Système de smileys.
				- Gestion des données utilisateurs (age, lieu etc),
				  avec par exemple des pages peronnelles de profil.
				- Deletion de compte.
				- Changement de mot de passe.
				- Pannel administrateur avec toutes les salles de chat
				  et les utilisateurs pour modifier les informations et
				  faire des suppressions.

	Enfin pour ce qui est de la conformation de compte par e-mail, nous ne l'avons
volontairement pas mise au point à cause du délai que met OVH à envoyer les mails avec 
la fonction mailto. 
	Théoriquement, il faudrait créer une nouvelle ligne "activated" dans a table users avec un
TINYINT sur 0 à l'inscription. Ensuite un faudrait générer une chaine de caractère aléatoire à
mettre en GET dans le lien d'activation à envoyer via mailto ET dans une ligne dans la table users
nommée key (par exemple). 
	(ex : domaine.com/activation?key=chainedecaracteres)
Sur la page d'activation un script php vérifirait la concordance entre la key récupérée en GET et 
la key enregistré dans la base de donnée pour l'utilisateur pour passer "activated" sur 1.

Ainsi le login serait possible que pour les utilisateurs ayant "activated" sur 1.

