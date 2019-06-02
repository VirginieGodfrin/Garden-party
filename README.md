README.md

# Garden Party
Garden party est un projet dont le but est d'expérimenter l'héritage de classe avec doctrine ORM.

## Les différents types d'héritage :
1. "Mapped Superclasses" - [la Super Classe.](https://github.com/VirginieGodfrin/Garden-party/blob/master/src/Model/MappedSuperclassBase.php) !

2. "Single Table Inheritance" - [Héritage de table unique.](https://github.com/VirginieGodfrin/Garden-party/commit/96be21f8cec3c699b1a4715aa4df39494565e533)

Nous avons une classe racinne 'User' et 2 classes feuilles 'Jardinier' & 'Mangeur'. Les classes feuilles n'existent pas en bases de donnée leurs propriétées correspondent à des colonnes contenues dans la table user. Nous pouvons les différentier par la colonne discr.
>["discr"]=>
    string(9) "jardinier"

3. "Class Table Inheritance" - [Héritage de table de classe.](https://github.com/VirginieGodfrin/Garden-party/commit/c0e2faec9a6f5bec0483ddcc15351b3254ee03c7)

Nous avons une classe racinne 'Vegetal' et 3 classes feuilles 'Fruit', 'Fleur', 'Legume'.
En base de donnée, nous avons 4 tables: vegetal, fruit, fleur, legume.
La table vegetal qui correspond à la classe racinne contient une colonne 'discriminante' :
>["discr"]=>
       string(6) "legume"

Et pas seulement elle contient une colonne pour chacunes de ses propriétes (nom, description, createdAt ...)
Les tables correspondants aux classes feuilles contiennent des colonnes pour leur propriétées respectives.  
