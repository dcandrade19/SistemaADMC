<<<<<<< HEAD
create table if not exists avisos(
	id int(11) not null AUTO_INCREMENT,
    titulo varchar(255) not null,
    descricao text,
    status int(1) not null,
    id_condominio int,
    
    PRIMARY KEY(id),
    FOREIGN KEY (id_condominio) REFERENCES condominios(id)
=======
create table if not exists avisos(
	id int(11) not null AUTO_INCREMENT,
    titulo varchar(255) not null,
    descricao text,
    status int(1) not null,
    id_condominio int,
    
    PRIMARY KEY(id),
    FOREIGN KEY (id_condominio) REFERENCES condominios(id)
>>>>>>> 383c10ba9d48ad89772a8dd6c1115cb2aaa3efe1
);