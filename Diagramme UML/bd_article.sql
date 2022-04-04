/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  04/04/2022 13:49:09                      */
/*==============================================================*/


drop table if exists Article;

/*==============================================================*/
/* Table : Article                                              */
/*==============================================================*/
create table Article
(
   code                 int not null,
   libelle              varchar(254),
   quantite             int,
   prixUnitaire         int,
   provenance           varchar(254),
   primary key (code)
);

