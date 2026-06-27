CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo INT DEFAULT 3,
    foto VARCHAR(255),
    ativo TINYINT(1) DEFAULT 1,
    token VARCHAR(255),
    ultimo_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table tipoacesso(
    id int auto_increment primary key,
    nome varchar(100) not null
);

insert into
    tipoacesso (id, nome)
values
    (1, 'ADMIN');

insert into
    tipoacesso (id, nome)
values
    (2, 'MOD');

insert into
    tipoacesso (id, nome)
values
    (3, 'PARTICIPANTE');

CREATE TABLE participantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    cpf VARCHAR(14),
    rg VARCHAR(20),
    sexo CHAR(1),
    nascimento DATE,
    telefone VARCHAR(20),
    celular VARCHAR(20),
    cep VARCHAR(10),
    logradouro VARCHAR(150),
    numero VARCHAR(20),
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    estado CHAR(2),
    igreja VARCHAR(150),
    comunidade VARCHAR(150),
    FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
CREATE TABLE logs_login(

    id INT AUTO_INCREMENT PRIMARY KEY,

    usuario_id INT,

    ip VARCHAR(45),

    navegador VARCHAR(255),

    sucesso TINYINT(1),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(usuario_id)
        REFERENCES usuarios(id)

);