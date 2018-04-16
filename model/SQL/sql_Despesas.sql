create table if not exists despesas(
	id int(11) not null AUTO_INCREMENT,
    titulo varchar(255) not null,
    descricao text,
    valor decimal(10,2) not null,
    
    PRIMARY KEY(id)
 
);