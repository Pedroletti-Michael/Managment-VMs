# **LDAP & LDAPs connexion - PHP**

## Prérequis

Pour effectuer une connexion via LDAP ou LDAPs en php il y a quelques prérequis. Tout d'abord il faut vérifier que dans le php.ini de votre serveur les extensions concernant la connexion LDAP [NOM D'EXTENSIONÀ RETROUVER], mais il vous faudra aussi bien vérifier que les deux fichiers .dll sont présent dans l'arborescence de votre fichier php [NOM DE FICHIER À RETROUVER].



## Explication du fonctionnement

Les protocoles LDAP a été développé afin d'avoir un protocole standardisé pour les requêtes en direction d'un Active Directory.  Il est basé sur le protocole TCP/IP. Le LDAPs n'est que la version protégée du LDAP.



## Utilisation concrête

Tout d'abord il va vous falloir ouvrir une connexion avec la commande suivante :

- ldap_connect($uri)

Le $uri contenant donc un lien URI, voir [ici](https://fr.wikipedia.org/wiki/Uniform_Resource_Identifier) pour plus d'information. Cette commande va tester si il est possible d'ouvrir une connexion avec l'hôte sélectionner.