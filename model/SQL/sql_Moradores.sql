create table if not exists moradores(
	id int(11) not null AUTO_INCREMENT,
    nome varchar(255) not null,
    status int(1) not null,
    cpf varchar(255) not null,
    id_apartamento int,
    id_usuario int,
    
    PRIMARY KEY(id),
    FOREIGN KEY (id_apartamento) REFERENCES apartamentos(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
 
);