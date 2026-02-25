create database r401_tp5;

CREATE USER 'r401_tp5'@'localhost' IDENTIFIED BY '7z3AgWdX54Zkq5.';
GRANT ALL PRIVILEGES ON r401_tp5.* TO 'r401_tp5'@'localhost';
FLUSH PRIVILEGES;

drop table if exists contact;

create table contact
(
    contact_id              int          not null auto_increment,
    nom                     varchar(50)  not null,
    prenom                  varchar(50)  not null,
    adresse                 varchar(50)  not null,
    code_postal             varchar(5)   not null,
    ville                   varchar(50)  not null,
    telephone               varchar(10)  not null,
    normalized_contact_data varchar(250) not null,
    constraint pk_contact primary key (contact_id)
);


insert into contact(nom, prenom, adresse, code_postal, ville, telephone, normalized_contact_data)
values ("BROISIN", "Julien", "133 B, Avenue de Rangueil BP 67701", "31077", "TOULOUSE", "0444832849",
        "BROISIN Julien 133 B, Avenue de Rangueil BP 67701 31077 TOULOUSE 0444832849");
insert into contact(nom, prenom, adresse, code_postal, ville, telephone, normalized_contact_data)
values ("ARNAULT", "Brice", "133 B, Avenue de Rangueil BP 67701", "31077", "TOULOUSE", "0803789989",
        "ARNAULT Brice 133 B, Avenue de Rangueil BP 67701 31077 TOULOUSE 0803789989");
insert into contact(nom, prenom, adresse, code_postal, ville, telephone, normalized_contact_data)
values ("PIQUÉ", "Gaétan", "13 rue des sanguinettes", "31520", "RAMONVILLE", "0937994681",
        "PIQUÉ Gaétan 13 rue des sanguinettes 31520 RAMONVILLE 0937994681");
insert into contact(nom, prenom, adresse, code_postal, ville, telephone, normalized_contact_data)
values ("MICHEAU", "Paul", "13 rue des sanguinettes", "31520", "RAMONVILLE", "0285306766",
        "MICHEAU, Paul, 13 rue des sanguinettes, 31520, RAMONVILLE, 0285306766");

commit;