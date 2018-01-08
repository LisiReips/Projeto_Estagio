create table pacientes
(
	id varchar(15) NOT NULL,
	caminho_img varchar(50) NOT NULL,
	nome varchar(150) NOT NULL,
	rua varchar(150) NOT NULL,
	num varchar(10) NOT NULL,
	bairro varchar(150) NOT NULL,
	cidade varchar(150) NOT NULL,
	uf char(2) NOT NULL,
	cep varchar(10) NOT NULL,
	latitude decimal(10,8) NOT NULL,
	longitude decimal(11,8) NOT NULL,
	CONSTRAINT pk_pacientes PRIMARY KEY (id)
);

create table doencas
(
	id serial NOT NULL,
	nome varchar(150) NOT NULL,
	abrev varchar(10) NOT NULL,
	detalhes varchar(150) NOT NULL,
	CONSTRAINT pk_doencas PRIMARY KEY (id)
);

create table pacientes_doencas
(
	id_pacientes varchar(15) NOT NULL,
	id_doencas serial NOT NULL,
	CONSTRAINT pk_id_pacientes_doencas PRIMARY KEY (id_pacientes, id_doencas),
	CONSTRAINT fk_id_pacientes FOREIGN KEY (id_pacientes) REFERENCES pacientes (id),
	CONSTRAINT fk_id_doencas FOREIGN KEY (id_doencas) REFERENCES doencas (id)
);