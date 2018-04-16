create table if not exists usuarios(
	id int(11) not null AUTO_INCREMENT,
    login varchar(255) not null,
    senha varchar(255) not null,
    status int(1) not null,
    nivel int(2) not null,
    
    PRIMARY KEY(id)
);

INSERT INTO `usuarios`(`login`, `senha`, `status`, `nivel`) 
 
VALUES ('admin', '$2y$10$XNJu/hB4EXc.flzVECCgSuwQRbfETgkWfKwEdlaQwG/X81IMZ5cM6', 1, 0);