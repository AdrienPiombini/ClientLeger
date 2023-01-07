DROP DATABASE IF EXISTS dsa;
CREATE DATABASE dsa;
use dsa;

create table users (
iduser int(3) not null  auto_increment ,
email varchar (150),
mdp varchar (50),
roles enum ('admin', 'technicien', 'client'),
primary key (iduser)
);


/*
----------------


create table client (
nom varchar(50),
adresse varchar(50),
ville varchar (50),
cp varchar (50), 
primary key (iduser)
);

create table panier()
Id commande 
Id user 
Nom produit 
Prix produit 
Quantité produit );

Créer l'héritage'
ajouter les triggers

----------------
*/



insert into users (email, mdp, roles) values ('admin@gmail.com', sha1('admin'), 'admin');
insert into users (email, mdp, roles) values ('client@gmail.com', sha1('client'), 'client');
insert into users (email, mdp, roles) values ('tech@gmail.com', sha1('tech'), 'technicien');



create table intervention (
    idintervention int(3) not null auto_increment,
    libelle varchar(50),
    dateintervention date,
    iduser int(3),
    primary key (idintervention),
    foreign key (iduser) references users(iduser) ON DELETE CASCADE ON UPDATE CASCADE
   
) ENGINE=INNODB;

insert into intervention (libelle, dateintervention, iduser) values ('reparation', curdate(), 1);




create table commande 
(   idCommande int not null auto_increment,
    dateCommande date ,
    nbProduit int(5)  ,
    montantHT float(5,2) ,
    tvaCommande float(5,2)  ,
    montantTTC float (9,2) ,
    dateLivraison date,
    iduser int  ,
    constraint pk_commande primary key (idCommande),
    constraint fk_client foreign key (iduser) references users(iduser)
);

insert into commande (dateCommande, nbProduit, montantHT,montantTTC, dateLivraison, iduser) values (curdate(), 1, 100, 120, curdate(), 2);

create table produit (
    idProduit int auto_increment not null,
    nomProduit varchar(25) not null,
    prixProduit float (5,2) not null,
    description varchar(8000),
    quantite int
    constraint pk_produit primary key (idProduit)
);

---- insertion produit 
insert into produit (nomProduit, prixProduit, description) values ('pneu', 250, '- Neuf comme usé, ce pneu offre un freinage remarquable sur routes mouillées..
- Adhérence exceptionnelle sur sol mouillé.
- Une consommation moindre et un kilométrage supérieur de 20 % par rapport à son prédécesseur.');
insert into produit (nomProduit, prixProduit, description ) values ('phare', 150, "Le projecteur de complément antibrouillard VALEO permet d'apporter un complément d'éclairage. Les projecteurs antibrouillard contribuent à une amélioration de la sécurité en améliorant la visibilité de l'automobiliste. Ceux-ci procurent un éclairage uniforme sur toute la largeur de la route, fournissant ainsi un large faisceau de lumière pour une conduite plus sûre, adaptée aux conditions climatiques extrêmes.");
insert into produit (nomProduit, prixProduit, description ) values ('siege', 125, "Ce siège-auto rotatif avec système Isofix offre un confort optimal à la fois aux parents et aux enfants, et peut être utilisé dos ou face à la route. Grâce à sa rotation latérale côté portière, l’installation de votre enfant est plus facile. Son design élégant et moderne vous séduira et la sécurité garantira un voyage en toute tranquillité.
");
insert into produit (nomProduit, prixProduit, description ) values ('siege2', 130, "Ce siège-auto rotatif avec système Isofix offre un confort optimal à la fois aux parents et aux enfants, et peut être utilisé dos ou face à la route. Grâce à sa rotation latérale côté portière, l’installation de votre enfant est plus facile. Son design élégant et moderne vous séduira et la sécurité garantira un voyage en toute tranquillité.
");
insert into produit (nomProduit, prixProduit, description ) values ('parchoc', 65, "Un pare-chocs est un élément de carrosserie en métal ou en plastique situé devant et derrière une voiture. Il permet d'atténuer les dégâts en cas de collision avec un autre véhicule ou objet. Orthographe simplifiée : pare-choc.");
insert into produit (nomProduit, prixProduit, description ) values ('moteur', 850, "Le moteur Gaposa Rapido LP6090/TMM avec parachute et électrofrein incorporés motorise parfaitement les portes industrielles rapides, il a une force de 60 newtons, une puissance de 950 W et une vitesse de 90 tours minute.

Moteur Rapido Gaposa avec commande de secours manivelle standard possédant des fins de course mécaniques.");
insert into produit (nomProduit, prixProduit, description ) values ('jante', 175, "La jante Spike est une jante de haute qualité, elle fait partie de la gamme INFINY. Intemporelle, cette jante vous séduira avec ses 10 doubles branches. Son design lui confère une allure élégante et sportive.

Les photos de nos jantes aluminium ne tiennent pas compte de la typologie de votre véhicule. Elles peuvent être présentées en 4 ou 5 trous. Pour vérifier que la jante dispose bien du nombre de trous souhaité, nous vous invitons à consulter dans le tableau ci-dessous les caractéristiques de cette jante.
");
insert into produit (nomProduit, prixProduit, description ) values ('essuie-glace', 35, "Les essuie-glaces plats BOSCH Clearview permettent de remplacer les balais d'essuie-glaces métalliques et d’améliorer les performances d’essuyage : une visibilité optimale pour une sécurité maximale. Les 2 raidisseurs de haute technologie en acier Evodium répartissent la pression exercée par le bras d'essuyage de manière uniforme d’un bout à l’autre de l’essuie-glace.
Les essuies-glaces BOSCH Clearview sont particulierement facile et rapide à monter. Pour faciliter le montage, le balai est vendu avec 1 adaptateur prémonté");


create view vue_intervention_and_users as(
    select i.*, u.email from intervention i inner join users u on i.iduser = u.iduser
);
