README.md

# Garden Party
Garden party est un projet dont le but est d'expérimenter l'héritage de classe avec doctrine ORM.

## Les différents types d'héritage :
1. ### "Mapped Superclasses" - [la Super Classe.](https://github.com/VirginieGodfrin/Garden-party/blob/master/src/Model/MappedSuperclassBase.php)

Sans véritable intéret !

[doc](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/inheritance-mapping.html#mapped-superclasses)

2. ### "Single Table Inheritance" - [Héritage de table unique.](https://github.com/VirginieGodfrin/Garden-party/commit/96be21f8cec3c699b1a4715aa4df39494565e533)

Nous avons une **classe mère** 'User' et deux **classes enfants** 'Jardinier' & 'Mangeur'. Les classes enfants ne sont pas représentées en base de données. Leurs propriétées correspondent aux colonnes contenues dans la table 'user'. Nous pouvons les différentier par la **colonne discriminante**.
>["discr"]=>
    string(9) "jardinier"

[doc](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/inheritance-mapping.html#single-table-inheritance)

3. ### "Class Table Inheritance" - [Héritage de table de classe.](https://github.com/VirginieGodfrin/Garden-party/commit/c0e2faec9a6f5bec0483ddcc15351b3254ee03c7)

Nous avons une classe mère 'Vegetal' et trois classes enfants 'Fruit', 'Fleur', 'Legume'.
En base de donnée, nous avons quatre tables: 'vegetal', 'fruit', 'fleur', 'legume'.
La table 'vegetal' qui correspond à la classe mère contient une colonne discriminante :
>["discr"]=>
       string(6) "legume"

les valeurs de cette colonne corespondent aux clés passées dans le DiscriminatorMap et aux noms des différentes classes enfants ! De plus, elle contient une colonne pour chacunes de ses propriétes (nom, description, createdAt ...)
Les tables correspondantes aux classes enfant contiennent des colonnes pour leur propriétées respectives.

ccl: Pour créer l'héritage de classe, qu'il soit unique (STI) ou sur une classe (CTI), il est nécessaire de déclarer **le type d'héritage**, **la colonne discriminante** et **le discriminatorMap**.
>   /**
>   
>    *@ORM\Entity
>    
>    *@ORM\InheritanceType("JOINED")
>    
>    *@ORM\DiscriminatorColumn(name="discr", type="string")
>    
>    *@ORM\DiscriminatorMap({ "vegetal" = "Vegetal", "fleur" = "Fleur", "fruit" = "    Fruit", "legume" = "Legume })
>    
>    */
> 
>    /**
>    
>    *@ORM\Entity
>    
>    *@ORM\InheritanceType("SINGLE_TABLE")
>    
>    *@ORM\DiscriminatorColumn(name="discr", type="string")
>    
>    *@ORM\DiscriminatorMap({"user" = "User", "jardinier" = "Jardinier", "mangeur" = "Mangeur" })
>    
>    */

[doc](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/inheritance-mapping.html#class-table-inheritance)

## [DoctrineExtensions](https://symfony.com/doc/current/doctrine/common_extensions.html)
Doctrine Extensions, le bon copain de doctrine dont le but est de nous faciliter la vie avec des fonctionalités tel que **Sluggable**, **Timestampable** et ... .

Nous avons utilisé Slugable pour nomer de façon unique le paramettre passé dans les urls. [le slug](https://github.com/VirginieGodfrin/Garden-party/commit/211b17a80861f6d9709f1c61c4fbeb4756cdf87a)
>/**
>
> *@Gedmo\Slug(fields={"nom"})
> 
> *@ORM\Column(type="string", length=255, unique=true)
> 
> */
> 
> private $slug;

Nous avons utilisé Timestampable pour ajouter systématiquement les propriétés createdAt et updatedAt de type dateTimes aux classes enfant. [Timestampable](https://github.com/VirginieGodfrin/Garden-party/commit/e75afe45586b937a1377a6934c207c7bd34b97d7)
>use TimestampableEntity;

ccl: Les proriétées communes aux classes enfant doivent être ajoutée à la classe mère. C'est pour cette raison que nous utilisons l'héritage de classe !

[Slug doc](https://github.com/Atlantic18/DoctrineExtensions/blob/v2.4.x/doc/sluggable.md) // [Timestampable doc](https://github.com/Atlantic18/DoctrineExtensions/blob/v2.4.x/doc/timestampable.md)

##  Les relations:
Il existe 3 types de relation OneToOne (OTO) ManyToOne/OneToMany (MTO/OTM) et ManyToMany (MTM); nous en testerons deux **ManyToOne/OneToMany** et **ManyToMany**

### [ManyToOne/OneToMany](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/association-mapping.html#one-to-many-bidirectional)
1. [Relation MTO/OTM entre une classe mère et une classe enfant.](https://github.com/VirginieGodfrin/Garden-party/blob/master/readMe/O1.mto_readme.md)
2. [Relation MTO/OTM entre deux classes enfants]()

### [ManyToMany](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/association-mapping.html#one-to-many-bidirectional)
1. [Relation MTM entre une classe mère et une classe feuille.](https://github.com/VirginieGodfrin/Garden-party/blob/master/readMe/02.mtm_readme.md)



NB: Ce projet est une ébauche d'un tuto. Merci d'être indulgent pour l'aspect brouillon de la chose ! 


