create table if not exists apartamentos(
	id int(11) not null AUTO_INCREMENT,
    numero int(11) not null,
    status int(1) not null,
    id_condominio int,
    
    PRIMARY KEY(id),
    FOREIGN KEY (id_condominio) REFERENCES condominios(id)
);