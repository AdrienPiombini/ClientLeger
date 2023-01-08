DROP DATABASE IF EXISTS dsa;
CREATE DATABASE dsa;
use dsa;

----- Utilisateurs

create table users (
iduser int(3) not null  auto_increment,
email varchar (150) unique,
mdp varchar (50),
nom varchar (50),
roles enum ('admin', 'technicien', 'client'),
constraint pk_user primary key (iduser)
);


create table admin(
    iduser int(3) not null  auto_increment ,
    email varchar (150),
    mdp varchar (50),
    nom varchar (50),
    roles enum ('admin', 'technicien', 'client'),
    prenom varchar(50),
    constraint pk_user primary key (iduser)
);

create table technicien (
    iduser int(3) not null  auto_increment ,
    email varchar (150),
    mdp varchar (50),
    nom varchar (50),
    roles enum ('admin', 'technicien', 'client'),
    prenom varchar(50),
    diplome varchar(50),
    dateEmb date,
    dateDept date,
    constraint pk_user primary key (iduser)
);

create table client (
iduser int(3) not null  auto_increment ,
email varchar (150),
mdp varchar (50),
nom varchar (50),
roles enum ('admin', 'technicien', 'client') default 'client',
adresse varchar(50),
ville varchar (50),
cp varchar (50), 
telephone int,
constraint pk_user primary key (iduser)
);


create table particulier (
iduser int(3) not null  auto_increment ,
email varchar (150),
mdp varchar (50),
nom varchar (50),
roles enum ('admin', 'technicien', 'client') default 'client',
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
mdp varchar (50),
nom varchar (50),
roles enum ('admin', 'technicien', 'client') default 'client',
adresse varchar(50),
ville varchar (50),
cp varchar (50), 
telephone int,
numeroSiret int,
constraint pk_user primary key (iduser)
);



/*-----------------Triggers Utilisateurs    */


/* AJOUT USERS */ 

drop trigger if exists ajout_particulier;
delimiter // 
create trigger ajout_particulier
before insert on particulier 
for each row 
begin 
declare user int;
select count(*) into user from users where email = new.email;
if user = 0 then 
    insert into users (email, mdp, roles, nom) values (new.email, new.mdp, 'client', new.nom);
    insert into client (email, mdp, roles, nom, adresse, ville, cp, telephone) values (new.email, new.mdp, 'client', new.nom, new.adresse, new.ville, new.cp, new.telephone);
else 
    signal sqlstate '45000'
    set message_text = 'Données déja existentes';
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
select count(*) into user from users where email = new.email;
if user = 0 then 
    insert into users (email, mdp, roles, nom) values (new.email, new.mdp, 'client', new.nom);
    insert into client (email, mdp, roles, nom, adresse, ville, cp, telephone) values (new.email, new.mdp, 'client', new.nom, new.adresse, new.ville, new.cp, new.telephone);
else 
    signal sqlstate '45000'
    set message_text = 'Données déja existentes';
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

update particulier set  email = 'adrien@gmail.com' , nom = 'toto' where iduser= 2;

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


/*

INSERT INTO particulier (email, mdp, nom, roles, adresse, ville, cp, telephone, prenom)
VALUES ('user1@gmail.com', 'password1', 'User 1', 'client', '1 Main St', 'New York', '12345', 123456789, 'John');

INSERT INTO particulier (email, mdp, nom, roles, adresse, ville, cp, telephone, prenom)
VALUES ('user2@gmail.com', 'password2', 'User 2', 'client', '2 Main St', 'Chicago', '23456', 234567891, 'Jane');

INSERT INTO particulier (email, mdp, nom, roles, adresse, ville, cp, telephone, prenom)
VALUES ('user3@gmail.com', 'password3', 'User 3', 'client', '3 Main St', 'Los Angeles', '34567', 345678912, 'Mark');

INSERT INTO particulier (email, mdp, nom, roles, adresse, ville, cp, telephone, prenom)
VALUES ('user4@gmail.com', 'password4', 'User 4', 'client', '4 Main St', 'Houston', '45678', 456789123, 'Kate');

INSERT INTO particulier (email, mdp, nom, roles, adresse, ville, cp, telephone, prenom)
VALUES ('user5@gmail.com', 'password5', 'User 5', 'client', '5 Main St', 'Philadelphia', '56789', 567891234, 'David');

INSERT INTO professionnel (email, mdp, nom, roles, adresse, ville, cp, telephone, numeroSiret)
VALUES ('company1@gmail.com', 'password1', 'Company 1', 'client', '1 Main St', 'New York', '12345', 123456789, 1234567890);

INSERT INTO professionnel (email, mdp, nom, roles, adresse, ville, cp, telephone, numeroSiret)
VALUES ('company2@gmail.com', SHA1('password2'), 'Company 2', 'client', '2 Main St', 'Chicago', '23456', 234567891, 234567901);

INSERT INTO professionnel (email, mdp, nom, roles, adresse, ville, cp, telephone, numeroSiret)
VALUES ('company3@gmail.com', SHA1('password3'), 'Company 3', 'client', '3 Main St', 'Los Angeles', '34567', 345678912, 345789012);

INSERT INTO professionnel (email, mdp, nom, roles, adresse, ville, cp, telephone, numeroSiret)
VALUES ('company4@gmail.com', SHA1('password4'), 'Company 4', 'client', '4 Main St', 'Houston', '45678', 456789123, 456780123);

INSERT INTO professionnel (email, mdp, nom, roles, adresse, ville, cp, telephone, numeroSiret)
VALUES ('company5@gmail.com', SHA1('password5'), 'Company 5', 'client', '5 Main St', 'Philadelphia', '56789', 567891234, 567801234);

INSERT INTO professionnel (email, mdp, nom, roles, adresse, ville, cp, telephone, numeroSiret)
VALUES ('company6@gmail.com', SHA1('password6'), 'Company 6', 'client', '6 Main St', 'Seattle', '67890', 678910123, 678101235);


INSERT INTO admin (email, mdp, roles, nom) VALUES ('Hannah@gmail.com', SHA1('password3'), 'admin', 'Hannah'); 
  update particulier set ville = 'poitier' where iduser = 3;
insert into particulier (email, mdp, nom) values ('jeanne@gmail.com', sha1('jean'),'jean'); 
insert into particulier (email, mdp, nom, adresse, ville, cp, telephone, prenom) values ('adrien@gmail.com', sha1('adrien'),'adrien', '126 rue charles floquet', 'Paris', '75014', 0123456789, 'Adrien'); 
insert into particulier (email, mdp, nom, adresse, ville, cp, telephone, prenom) values ('kevin@gmail.com', sha1('kevin'),'kevin', '126 rue charles floquet', 'Paris', '75014', 0123456789, 'Kevin'); 



insert into users (email, mdp, roles, nom) values ('admin@gmail.com', sha1('admin'), 'admin', 'admin');
insert into users (email, mdp, roles, nom) values ('client@gmail.com', sha1('client'), 'client', 'Jean');
insert into users (email, mdp, roles, nom) values ('tech@gmail.com', sha1('tech'), 'technicien', 'Mathieu');
INSERT INTO users (email, mdp, roles, nom) VALUES ('Alice@gmail.com', SHA1('password1'), 'client', 'Alice');
INSERT INTO users (email, mdp, roles, nom) VALUES ('Bob@gmail.com', SHA1('password2'), 'technicien', 'Bob');
INSERT INTO users (email, mdp, roles, nom) VALUES ('Charlie@gmail.com', SHA1('password3'), 'admin', 'Charlie');
INSERT INTO users (email, mdp, roles, nom) VALUES ('David@gmail.com', SHA1('password4'), 'client', 'David');
INSERT INTO users (email, mdp, roles, nom) VALUES ('Emily@gmail.com', SHA1('password5'), 'technicien', 'Emily');
INSERT INTO users (email, mdp, roles, nom) VALUES ('Frank@gmail.com', SHA1('password1'), 'client', 'Frank');
INSERT INTO users (email, mdp, roles, nom) VALUES ('George@gmail.com', SHA1('password2'), 'technicien', 'George');
INSERT INTO users (email, mdp, roles, nom) VALUES ('Isabelle@gmail.com', SHA1('password4'), 'client', 'Isabelle');
INSERT INTO users (email, mdp, roles, nom) VALUES ('Jack@gmail.com', SHA1('password5'), 'technicien', 'Jack');




create table panier(
Id commande 
Id user 
Nom produit 
Prix produit 
Quantité produit );

Créer l'héritage'
ajouter les triggers


*/


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
    quantite int,
    constraint pk_produit primary key (idProduit)
);

/*insertion produit  */
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


/* VUE */ 
create view vue_intervention_and_users as(
    select i.*, u.email from intervention i inner join users u on i.iduser = u.iduser
);