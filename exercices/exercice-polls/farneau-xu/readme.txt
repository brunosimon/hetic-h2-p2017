  _____                  _______                _       
 / ____|                |__   __|              | |      
| |     _ __ __ _ _____   _| |_      _____  ___| |_ ___ 
| |    | '__/ _` |_  / | | | \ \ /\ / / _ \/ _ \ __/ __|
| |____| | | (_| |/ /| |_| | |\ V  V /  __/  __/ |_\__ \
 \_____|_|  \__,_/___|\__, |_| \_/\_/ \___|\___|\__|___/
                        __/ |                            
                       |___/
 _______________________________________________________
 
Réalisé par :  
- Tristan Farneau
- Giovanni Xu

FONCTIONNALITÉS
***************

CrazyTweets permet de noter les tweets selon les critères « WTF », « LOL », « CHOC », « WIN », « FAIL », « CUTE », « HOT ». Des tops sont ensuite créés en fonction des votes. La recherche des tweets se fait par hashtag.  

TECHNOLOGIES UTILISÉES
**********************

- PDO pour la gestion de la base de donnée
- jQuery pour le chargement des pages en Ajax
- API tweeter pour la recherche des tweets par hashtag et par id
- Cookies pour empêcher le multi-vote

INSTALLATION
************

- includes/config.php : modifier les infos de connexion MySQL (les infos de l’API twitter sont déjà renseignés)
- db.sql : backup de la base SQL avec quelques tweets