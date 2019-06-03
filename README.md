README.md

# Garden Party
Garden party est un projet dont le but est d'expérimenter l'héritage de classe avec doctrine ORM.

## Les différents types d'héritage :
1. ### "Mapped Superclasses" - [la Super Classe.](https://github.com/VirginieGodfrin/Garden-party/blob/master/src/Model/MappedSuperclassBase.php)

Sans véritable intéret !

[doc](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/inheritance-mapping.html#mapped-superclasses)

2. ### "Single Table Inheritance" - [Héritage de table unique.](https://github.com/VirginieGodfrin/Garden-party/commit/96be21f8cec3c699b1a4715aa4df39494565e533)

Nous avons une **classe racinne** 'User' et deux **classes feuilles** 'Jardinier' & 'Mangeur'. Les classes feuilles n'existent pas en base de données. Leurs propriétées correspondent à des colonnes contenues dans la table 'user'. Nous pouvons les différentier par la **colonne discriminante**.
>["discr"]=>
    string(9) "jardinier"

[doc](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/inheritance-mapping.html#single-table-inheritance)

3. ### "Class Table Inheritance" - [Héritage de table de classe.](https://github.com/VirginieGodfrin/Garden-party/commit/c0e2faec9a6f5bec0483ddcc15351b3254ee03c7)

Nous avons une classe racinne 'Vegetal' et trois classes feuilles 'Fruit', 'Fleur', 'Legume'.
En base de donnée, nous avons quatre tables: 'vegetal', 'fruit', 'fleur', 'legume'.
La table 'vegetal' qui correspond à la classe racinne contient une colonne discriminante :
>["discr"]=>
       string(6) "legume"

les valeurs de cette colonne corespondent aux clés passées dans le DiscriminatorMap et aux noms des différentes classes feuilles ! De plus, elle contient une colonne pour chacunes de ses propriétes (nom, description, createdAt ...)
Les tables correspondantes aux classes feuilles contiennent des colonnes pour leur propriétées respectives.

ccl: Pour créer l'héritage de classe, qu'il soit unique (STI) ou sur une classe (CTI), il est nécessaire de déclarer **le type d'héritage**, **la colonne discriminante** et **le discriminatorMap**.
>/**
> * @ORM\Entity
> * @ORM\InheritanceType("JOINED")
> * @ORM\DiscriminatorColumn(name="discr", type="string")
> * @ORM\DiscriminatorMap({ "vegetal" = "Vegetal", "fleur" = "Fleur", "fruit" = "Fruit", "legume" = "Legume })
> * 
> */
> 
> /**
> * @ORM\Entity
> * @ORM\InheritanceType("SINGLE_TABLE")
> * @ORM\DiscriminatorColumn(name="discr", type="string")
> * @ORM\DiscriminatorMap({"user" = "User", "jardinier" = "Jardinier", "mangeur" = "Mangeur" })
> * 
> */

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

Nous avons utilisé Timestampable pour ajouter systématiquement les propriétés createdAt et updatedAt de type dateTimes aux classes feuilles. [Timestampable](https://github.com/VirginieGodfrin/Garden-party/commit/e75afe45586b937a1377a6934c207c7bd34b97d7)
>use TimestampableEntity;

ccl: Les proriétées communes aux classes feuilles doivent être ajoutée à la classe racinne. C'est pour cette raison que nous utilisons l'héritage de classe !

[Slug doc](https://github.com/Atlantic18/DoctrineExtensions/blob/v2.4.x/doc/sluggable.md) // [Timestampable doc](https://github.com/Atlantic18/DoctrineExtensions/blob/v2.4.x/doc/timestampable.md)

##  les relations
Il existe 3 types de relation OneToOne (OTO) ManyToOne/OneToMany (MTO) et ManyToMany (MTM); nous en testerons deux **ManyToOne/OneToMany** et **ManyToMany**

### [ManyToOne/OneToMany](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/association-mapping.html#one-to-many-bidirectional)
1. Relation MTO entre une classe racinne et une classe feuille.
Dans notre exemple, nous avons décidé que Mangeur (feuille) serait proriétaire de la relation et Vegetal (racinne) serait sont inverse. [ici](https://github.com/VirginieGodfrin/Garden-party/commit/1173c978f4509ec245774f41532c933de6abcdac)

> //src/Entity/Vegetal.php
> 
>   /**
>    * @ORM\ManyToOne(targetEntity="Mangeur", inversedBy="vegetals")
>    */
>    
>    private $mangeur;
>    
> //src/Entity/Mangeur.php 
>  
>   /**
>    * @ORM\OneToMany(targetEntity="App\Entity\Vegetal", mappedBy="mangeur")
>    */
>    
>    private $vegetals;

Nous constatons qu'en base de donnée la table vegetal va contenir la clé de la relation dans une colonne nommée 'mangeur_id'.
- Nous travaillons à partir de l'entité mangeur. 
Dans le controller Mangeur, pour récupérer les données de tous les mangeurs ainsi que les fleurs, fruits, et légumes, nous utilisons La méthode findAll().
Si l'on fait un dump(), nous pouvons voir la 'PersistentCollection' qui nous contient des données des entitées opposées.

>   public function indexAction(MangeurRepository $mangeurRepo)
>   
>   {
>       
>       $mangeurs = $mangeurRepo->findAll();
>       
>       return $this->render('mangeur/index.html.twig', [
>       
>           'mangeurs' => $mangeurs,
>           
>       ]);
>       
>   }

- Nous n'avons pas de controller pour la classe Vegetal. Nous travaillons sur ses classes feuilles: Fleur, Fruit, Legume.
Nous récupérons leurs données dans leurs controllers respectifs grâce à la méthode findAll(). Et les données de la classe propriétaire 'mangeur' leurs sont associées.

>   public function indexAction(LegumeRepository $legumeRepo)
>   
>   {  
>    
>       $legumes = $legumeRepo->findAll();
>       
>       return $this->render('legume/index.html.twig', [
>       
>           'legumes' => $legumes,
>           
>       ]);
>       
>   }

Merci LazyLoading !


NB: Ce projet est une ébauche d'un tuto. Merci d'être indulgent pour l'aspect brouillon de la chose ! 


