create table if not exists blocos(
	id int(11) not null AUTO_INCREMENT,
    nome varchar(255) not null,
    status int(1) not null,
    id_condominio int,
    
    PRIMARY KEY(id),
    FOREIGN KEY (id_condominio) REFERENCES condominios(id)
);