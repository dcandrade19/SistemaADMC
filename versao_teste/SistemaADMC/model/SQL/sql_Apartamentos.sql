create table if not exists apartamentos(
	id int(11) not null AUTO_INCREMENT,
    numero int(11) not null,
    status int(1) not null,
    id_bloco int,
    
    PRIMARY KEY(id),
    FOREIGN KEY (id_bloco) REFERENCES blocos(id)
);