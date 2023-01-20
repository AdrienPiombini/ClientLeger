DROP DATABASE IF EXISTS dsa;
CREATE DATABASE dsa;
use dsa;

/* UTILISATEURS */ 

create table users (
iduser int(3) not null  auto_increment,
email varchar (150) unique,
mdp varchar (255),
nom varchar (50),
roles enum ('admin', 'technicien', 'client'),
datemdp date, 
constraint pk_user primary key (iduser)
);


create table admin(
    iduser int(3) not null  auto_increment ,
    email varchar (150),
    mdp varchar (255),
    nom varchar (50),
    roles enum ('admin', 'technicien', 'client'),
    datemdp date, 
    prenom varchar(50),
    constraint pk_user primary key (iduser)
);

create table technicien (
    iduser int(3) not null  auto_increment ,
    email varchar (150),
    mdp varchar (255),
    nom varchar (50),
    roles enum ('admin', 'technicien', 'client'),
    datemdp date, 
    prenom varchar(50),
    diplome varchar(50),
    dateEmb date,
    dateDept date,
    constraint pk_user primary key (iduser)
);

create table client (
iduser int(3) not null  auto_increment ,
email varchar (150),
mdp varchar (255),
nom varchar (50),
roles enum ('admin', 'technicien', 'client') default 'client',
datemdp date, 
typeclient enum('particulier', 'professionnel'),
adresse varchar(50),
ville varchar (50),
cp varchar (50), 
telephone int,
constraint pk_user primary key (iduser)
);


create table particulier (
iduser int(3) not null  auto_increment ,
email varchar (150),
mdp varchar (255),
nom varchar (50),
roles enum ('admin', 'technicien', 'client') default 'client',
datemdp date, 
typeclient enum('particulier', 'professionnel') default 'particulier',
adresse varchar(50),
ville varchar (50),
cp varchar (50), 
telephone int,
prenom varchar(50),
constraint pk_user primary key (iduser)
);

create table professionnel (
iduser int(3) not null  auto_increment ,
email varchar (150),
mdp varchar (255),
nom varchar (50),
roles enum ('admin', 'technicien', 'client') default 'client',
datemdp date, 
typeclient enum('particulier', 'professionnel') default 'professionnel',
adresse varchar(50),
ville varchar (50),
cp varchar (50), 
telephone int,
numeroSiret int,
constraint pk_user primary key (iduser)
);

create table produit (
    idProduit int auto_increment not null,
    nomProduit varchar(25) not null,
    prixProduit float (5,2) not null,
    description varchar(8000),
    quantite int,
    constraint pk_produit primary key (idProduit)
);


create table panier(
idpanier int  not null,
iduser int not null,
idproduit int not null,
quantiteproduit int, 
statut enum('en cours', 'validée', 'annulée', 'archivée' ),
dateCommande date ,
tvaCommande varchar(4) ,
totalHT float (9,2),
totalTTC float (9,2),
constraint pk_panier primary key (idpanier, iduser, idproduit),
constraint fk_user foreign key (iduser) references users(iduser),
constraint fk_produit foreign key (idproduit) references produit(idProduit)
);


create table intervention (
    idintervention int(3) not null auto_increment,
    libelle varchar(50),
    dateintervention date,
    statut enum('En attente', 'En cours', 'Finalisée') default 'En attente',
    iduser int(3),
    idtechnicien int(3),
    primary key (idintervention),
    foreign key (iduser) references users(iduser),
    foreign key (idtechnicien) references technicien(iduser)

) ENGINE=INNODB;


create table grainSel(
    salt varchar(100) not null,
    constraint pk_salt primary key (salt)
);


/*-------------------PROCEDURE --------------------*/
drop procedure if exists gestion_panier;
delimiter  //
create procedure gestion_panier (idpan int, idu int, idprod varchar(25), qtprod int)
begin 
    declare prixprod float; 
    declare HT float;
    declare  TTC float; 
    insert into panier (idpanier, iduser, idproduit, quantiteproduit, statut, dateCommande, tvaCommande) values (idpan, idu, idprod, qtprod, 'en cours', curdate(), '20%');
    select prixProduit from produit where idproduit = idprod  into prixprod ;
    select  totalHT, totalTTC from panier where idpanier = idpan limit 1  into HT, TTC;
    if HT is null then 
        set HT = 0; 
    end if; 
    if TTC is null then 
        set TTC = 0;
    end if; 
    set HT = HT + (prixprod * qtprod);
    set TTC = TTC + (prixprod * qtprod * 1.2); 
    update panier set totalHT = HT, totalTTC = TTC where idpanier = idpan and iduser =idu ;
end ;
//
delimiter ;

/*-------------------------TRIGGERS --------------  */

/*insert into panier (idpanier, iduser, idproduit, quantiteproduit, statut, dateCommande, montantHT, tvaCommande, montantTTC) values (1, 1, 1, 1, 'en cours', curdate(), '12', '20%', '21'); */

/* AJOUT USERS */ 

drop trigger if exists ajout_particulier;
delimiter // 
create trigger ajout_particulier
before insert on particulier 
for each row 
begin 
declare user int;
declare grain varchar(100);
select salt into grain from grainSel;
set new.mdp = sha1(concat(new.mdp, grain));
select count(*) into user from users where email = new.email;
if user = 0 then 
    insert into users (email, mdp, roles, nom) values (new.email, new.mdp, 'client', new.nom);
    insert into client (email, mdp, roles, typeclient, nom, adresse, ville, cp, telephone) values (new.email, new.mdp, 'client', 'particulier', new.nom, new.adresse, new.ville, new.cp, new.telephone);
else 
    signal sqlstate '45000'
    set message_text = 'Données déja existantes';
end if;
end // 
delimiter ; 


drop trigger if exists ajout_professionnel;
delimiter // 
create trigger ajout_professionnel
before insert on professionnel 
for each row 
begin 
declare user int;
declare grain varchar(100);
select salt into grain from grainSel;
set new.mdp = sha1(concat(new.mdp, grain));
select count(*) into user from users where email = new.email;
if user = 0 then 
    insert into users (email, mdp, roles, nom) values (new.email, new.mdp, 'client', new.nom);
    insert into client (email, mdp, roles, typeclient, nom, adresse, ville, cp, telephone) values (new.email, new.mdp, 'client', 'professionnel', new.nom, new.adresse, new.ville, new.cp, new.telephone);
else 
    signal sqlstate '45000'
    set message_text = 'Données déja existantes';
end if;
end // 
delimiter ; 

drop trigger if exists ajouter_admin;
delimiter // 
create trigger ajouter_admin
before insert on admin 
for each row 
begin 
declare user int; 
declare grain varchar(100);
select salt into grain from grainSel;
set new.mdp = sha1(concat(new.mdp, grain));
select count(*) into user from users where email = new.email; 
if user = 0 then 
    insert into users (email, mdp, nom, roles) values (new.email, new.mdp, new.nom, 'admin');
else 
    signal sqlstate '45000'
    set message_text = "L'utilisateur existe déja !";
end if; 
end //
delimiter ;  


drop trigger if exists ajouter_tech;
delimiter // 
create trigger ajouter_tech
before insert on technicien 
for each row 
begin 
declare user int; 
declare grain varchar(100);
select salt into grain from grainSel;
set new.mdp = sha1(concat(new.mdp, grain));
select count(*) into user from users where email = new.email; 
if user = 0 then 
    insert into users (email, mdp, nom, roles) values (new.email, new.mdp, new.nom, 'technicien');
else 
    signal sqlstate '45000'
    set message_text = "L'utilisateur existe déja !";
end if; 
end //
delimiter ; 

/* MODIFIER USERS */

drop trigger if exists modifier_particulier;
delimiter // 
create trigger modifier_particulier 
before update on particulier
for each row 
begin 
        update users set email = new.email, nom = new.nom, mdp = new.mdp where email = old.email;
        update client set email = new.email, nom = new.nom, mdp = new.mdp, adresse = new.adresse, ville = new.ville, cp = new.cp, telephone = new.telephone  where email = old.email;
end // 
delimiter ; 


drop trigger if exists modifier_professionnel;
delimiter // 
CREATE TRIGGER modifier_professionnel
BEFORE UPDATE ON professionnel
FOR EACH ROW
BEGIN
    UPDATE users SET email = new.email, nom = NEW.nom, mdp = NEW.mdp WHERE email = OLD.email;
    UPDATE client SET email = NEW.email, nom = NEW.nom, mdp = NEW.mdp, adresse = NEW.adresse, ville = NEW.ville, cp = NEW.cp, telephone = NEW.telephone WHERE email = OLD.email;
END //
delimiter ; 


drop trigger if exists modifier_admin;
delimiter // 
create trigger modifier_admin
before update on admin
for each row 
begin 
UPDATE users SET email = new.email, nom = NEW.nom, mdp = NEW.mdp WHERE email = OLD.email;
end // 
delimiter ;

drop trigger if exists modifier_tech;
delimiter // 
create trigger modifier_tech
before update on technicien
for each row 
begin 
UPDATE users SET email = new.email, nom = NEW.nom, mdp = NEW.mdp WHERE email = OLD.email;
end // 
delimiter ;


/* SUPPRIMER USERS */

drop trigger if exists supprimer_user; 
delimiter // 
create trigger supprimer_user 
before   delete on users 
for each row 
begin 
    delete from client where email = old.email; 
    delete from particulier where email = old.email; 
    delete from professionnel where email = old.email; 
    delete from  technicien where email = old.email; 
    delete from admin where email = old.email;

    delete panier from panier inner join users on panier.iduser = users.iduser 
    left join particulier on users.email = particulier.email 
    left join professionnel on users.email = professionnel.email 
    left join admin on admin.email = users.email 
    left join technicien t on t.email = users.email 
    where users.iduser = old.iduser;

    delete intervention from intervention inner join users on intervention.iduser = users.iduser 
    left join particulier on users.email = particulier.email 
    left join professionnel on users.email = professionnel.email 
    left join admin on admin.email = users.email 
    left join technicien t on t.email = users.email 
    where users.iduser = old.iduser;

end // 
delimiter ;

/* VUE */ 
create  or replace view vue_intervention_and_users as(
    select intervention.* , users.nom as 'nomClient', technicien.nom as 'nomTech' 
    from intervention 
    inner join users on intervention.iduser = users.iduser 
    left join technicien on intervention.idtechnicien = technicien.iduser
);

create or replace view  vue_commande_en_cours as (
    select idpanier, iduser, sum(quantiteproduit) as "nbArticle", statut, totalHT, totalTTC, datecommande
    from panier
    where statut  in ('en cours', 'validée') 
    group by idpanier, iduser, statut, totalHT, totalTTC, datecommande
);

create or replace view  vue_commande_archive as (
    select idpanier, iduser, sum(quantiteproduit) as "nbArticle", statut, totalHT, totalTTC, datecommande
    from panier where statut in ('archivée', 'annulée')   
    group by idpanier, iduser, statut, totalHT, totalTTC, datecommande
);


/*-----------------_____________________INSERT______________________----------*/

/*** PRODUITS ******/
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

/*** USER ******/
insert into grainSel values('9876512347654238743656');

insert into admin (email, mdp, roles, nom) values ('admin@gmail.com', 'admin', 'admin', 'admin');
insert into particulier (email, mdp, roles, nom) values ('client@gmail.com', 'client', 'client', 'Jean');
insert into technicien (email, mdp, roles, nom) values ('tech@gmail.com', 'tech', 'technicien', 'Mathieu');
INSERT INTO particulier (email, mdp, roles, nom) VALUES ('Alice@gmail.com', 'password1', 'client', 'Alice');
INSERT INTO technicien (email, mdp, roles, nom) VALUES ('Bob@gmail.com', 'password2', 'technicien', 'Bob');
INSERT INTO admin (email, mdp, roles, nom) VALUES ('Charlie@gmail.com', 'password3', 'admin', 'Charlie');
INSERT INTO particulier (email, mdp, roles, nom) VALUES ('David@gmail.com', 'password4', 'client', 'David');
INSERT INTO technicien (email, mdp, roles, nom) VALUES ('Emily@gmail.com', 'password5', 'technicien', 'Emily');
INSERT INTO particulier (email, mdp, roles, nom) VALUES ('Frank@gmail.com', 'password1', 'client', 'Frank');
INSERT INTO technicien (email, mdp, roles, nom) VALUES ('George@gmail.com', 'password2', 'technicien', 'George');
INSERT INTO particulier (email, mdp, roles, nom) VALUES ('Isabelle@gmail.com', 'password4', 'client', 'Isabelle');
INSERT INTO technicien (email, mdp, roles, nom) VALUES ('Jack@gmail.com', 'password5', 'technicien', 'Jack');


/*** PANIER ******/
INSERT INTO panier (idpanier, iduser, idproduit, quantiteproduit, statut, dateCommande, tvaCommande ) 
VALUES (1, 1, 1, 2, 'en cours', '2022-01-01', '19.6');
INSERT INTO panier (idpanier, iduser, idproduit, quantiteproduit, statut, dateCommande, tvaCommande ) 
VALUES (1, 1, 2, 4, 'en cours', '2022-01-01', '19.6');
INSERT INTO panier (idpanier, iduser, idproduit, quantiteproduit, statut, dateCommande, tvaCommande ) 
VALUES (1, 1, 3, 1, 'en cours', '2022-01-01', '19.6');
INSERT INTO panier (idpanier, iduser, idproduit, quantiteproduit, statut, dateCommande, tvaCommande ) 
VALUES (1, 1, 4, 5, 'en cours', '2022-01-01', '19.6');
INSERT INTO panier (idpanier, iduser, idproduit, quantiteproduit, statut, dateCommande, tvaCommande ) 
VALUES (2, 2, 2, 1, 'validée', '2022-02-01', '19.6');
INSERT INTO panier (idpanier, iduser, idproduit, quantiteproduit, statut, dateCommande, tvaCommande) 
VALUES (3, 3, 3, 3, 'annulée', '2022-03-01', '19.6');


insert into intervention (libelle, dateintervention, iduser) values ('reparation', curdate(), 1);

/*

select idpanier, sum(quantiteproduit), sum(montantHT), nom from panier left join users on panier.iduser= users.iduser where idpanier = 1 group by panier.idpanier, users.nom
select panier.*, prixProduit, nom from panier, produit, users where panier.iduser = users.iduser and panier.idproduit = produit.idproduit

select idpanier, quantiteproduit, statut, prixProduit, nom from panier, produit, users where panier.iduser = users.iduser and panier.idproduit = produit.idproduit;


drop procedure if exists gestion_panier;
delimiter  //
create procedure gestion_panier (idpan int, idu int, idprod varchar(25), qtprod int)
begin 
declare PrixProduit float; 
declare totalHT float;
declare  totalTTC float; 
select prixProduit from produit where idproduit = idprod  into PrixProduit ;
set totalHT = PrixProduit * qtprod;
set totalHT = PrixProduit * qtprod * 1.2; 
insert into panier (idpanier, iduser, idproduit, quantiteproduit, statut, dateCommande, tvaCommande) values (idpan, idu, idprod, qtprod, 'en cours', curdate(), '20%');
update panier set totalHT = totalHT, totalTTC = totalTTC where idpanier = idpan and iduser =idu and idproduit = idprod;
end ;
//
delimiter ;

drop trigger if exists maj_panier; 
delimiter // 
create trigger maj_panier 
after insert on panier 
for each row 
begin 
    update vue_panier set totalHT = 1 where idpanier = new.idpanier;
end //
delimiter ;


drop procedure if exists gestion_panier;
delimiter  //
create procedure gestion_panier (idpanier int, iduser int, idproduit varchar(25), quantiteproduit int)
begin 
insert into panier (idpanier, iduser, idproduit, quantiteproduit, statut, dateCommande, tvaCommande) values (idpanier, iduser, idproduit, quantiteproduit, 'en cours', curdate(), '20%');
end ;
//
delimiter ;

drop trigger if exists maj_panier; 
delimiter // 
create trigger maj_panier 
after insert on panier 
for each row 
begin 
    update vue_panier set totalHT = 1 where idpanier = new.idpanier;
end //
delimiter ;

create view vue_user as ( 
    select * from users
);




select idpanier, sum(quantiteproduit) from vue_panier where idpanier = 1 group by idpanier with rollup;

select idpanier, nom, sum(quantiteproduit), montantHT from panier left join users on panier.iduser= users.iduser where idpanier = 1  group by ;  

select count(quantiteproduit), nom, montantHT from panier left join users on panier.iduser= users.iduser where idpanier = 1  group by idpanier, quantiteproduit ; 







create table commande (   
idCommande int not null auto_increment,
dateCommande date ,
nbProduit int(5)  ,
montantHT float(5,2) ,
tvaCommande float(5,2)  ,
montantTTC float (9,2) ,
dateLivraison date,
idpanier int, 
constraint pk_commande primary key (idCommande),
constraint fk_panier foreign key (idpanier) references panier(idpanier)
);



insert into commande (dateCommande, nbProduit, montantHT,montantTTC, dateLivraison, iduser) values (curdate(), 1, 100, 120, curdate(), 2);

OLD TRIGGER HERITAGE 

drop trigger if exists supprimer_particulier; 
delimiter // 
create trigger supprimer_particulier 
before delete on particulier 
for each row 
begin 
    delete from client where email = old.email; 
    delete from users where email = old.email; 
end //
delimiter ;

drop trigger if exists supprimer_professionnel; 
delimiter // 
create trigger supprimer_professionnel 
before delete on professionnel 
for each row 
begin 
    delete from client where email = old.email; 
    delete from users where email = old.email; 
end //
delimiter ;

drop trigger if exists supprimer_admin; 
delimiter // 
create trigger supprimer_admin 
before delete on admin 
for each row 
begin 
    delete from users where email = old.email; 
end //
delimiter ;

drop trigger if exists supprimer_tech; 
delimiter // 
create trigger supprimer_tech 
before delete on technicien 
for each row 
begin 
    delete from users where email = old.email; 
end //
delimiter ;



*/