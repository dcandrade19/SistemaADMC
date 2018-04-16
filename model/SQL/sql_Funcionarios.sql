create table if not exists funcionarios(
	id int(11) not null AUTO_INCREMENT,
    nome varchar(255) not null,
    status int(1) not null,
    cpf varchar(255) not null,
    id_despesa int,
    id_funcao int,
    id_condominio int,
    
    PRIMARY KEY(id),
    FOREIGN KEY (id_despesa) REFERENCES despesas(id),
    FOREIGN KEY (id_funcao) REFERENCES funcoes(id),
    FOREIGN KEY (id_condominio) REFERENCES condominios(id)
 
);