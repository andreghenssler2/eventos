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

CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200),
    descricao TEXT,
    banner VARCHAR(255),
    inicio DATETIME,
    fim DATETIME,
    local VARCHAR(200),
    cidade VARCHAR(100),
    estado CHAR(2),
    valor DECIMAL(10, 2),
    vagas INT,
    inscricao_inicio DATETIME,
    inscricao_fim DATETIME,
    certificado BOOLEAN DEFAULT FALSE,
    ativo BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE campos_evento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    evento_id INT,
    nome VARCHAR(100),
    label VARCHAR(150),
    tipo VARCHAR(30),
    placeholder VARCHAR(150),
    obrigatorio BOOLEAN,
    ordem INT,
    largura INT,
    opcoes TEXT,
    FOREIGN KEY(evento_id) REFERENCES eventos(id) ON DELETE CASCADE
);

CREATE TABLE inscricoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    evento_id INT,
    participante_id INT,
    status ENUM(
        'PENDENTE',
        'CONFIRMADO',
        'PRESENTE',
        'CANCELADO'
    ),
    valor DECIMAL(10, 2),
    forma_pagamento VARCHAR(30),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(evento_id) REFERENCES eventos(id),
    FOREIGN KEY(participante_id) REFERENCES participantes(id)
);

CREATE TABLE respostas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    inscricao_id INT,
    campo_id INT,
    valor TEXT,
    FOREIGN KEY(inscricao_id) REFERENCES inscricoes(id),
    FOREIGN KEY(campo_id) REFERENCES campos_evento(id)
);

CREATE TABLE certificados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    evento_id INT,
    participante_id INT,
    codigo VARCHAR(100),
    arquivo VARCHAR(255),
    emitido BOOLEAN DEFAULT FALSE,
    data_emissao DATETIME,
    FOREIGN KEY(evento_id) REFERENCES eventos(id),
    FOREIGN KEY(participante_id) REFERENCES participantes(id)
);