create database if not exists gestao_material_escolar;

use gestao_material_escolar;

create table if not exists instituicao(
    id int auto_increment, 
    email varchar(64) unique not null,
    nome varchar(64) not null,
    password varchar(128) not null,
    primary key (id)
);

create table if not exists requisitor(
    id int auto_increment, 
    email varchar(64) unique not null,
    nome varchar(64) not null,
    password varchar(128) not null,
    primary key (id)
);

create table if not exists tipo_material(
    id int auto_increment,
    nome varchar(64) unique not null,
    foto_url varchar(128),
    primary key (id)
); 


create table if not exists material(
    id int auto_increment,
    referencia varchar(64) not null unique,
    nome varchar(20) not null,
    id_tipo int,
    id_instituicao int, 
    primary key (id),
    foreign key (id_tipo) references tipo_material(id),
    foreign key (id_instituicao) references instituicao(id)
); 

create table if not exists sala(
    id int auto_increment,
    numero varchar(20) not null,
    id_instituicao int, 
    primary key (id),
    foreign key (id_instituicao) references instituicao(id)
);

create table if not exists requisicao(
    id int auto_increment,
    data_desejada date,
    hora_inicio time,
    hora_fim time,
    estado varchar(20),
    data_requisicao datetime,
    id_requisitor int,
    id_instituicao int,
    id_material int,
    id_sala int,
    primary key (id),
    foreign key (id_requisitor) references requisitor(id),
    foreign key (id_instituicao) references instituicao(id),
    foreign key (id_material) references material(id),
    foreign key (id_sala) references sala(id)
);

create table if not exists pedido(
    id_requisitor int,
    id_instituicao int,
    estado varchar(20),
    data_pedido datetime,
    primary key (id_requisitor, id_instituicao),
    foreign key (id_requisitor) references requisitor(id),
    foreign key (id_instituicao) references instituicao(id)
);

create table if not exists filiacao(
    id_instituicao int,
    id_requisitor int,
    data_entrada datetime,
    primary key (id_instituicao, id_requisitor),
    foreign key (id_requisitor) references requisitor(id),
    foreign key (id_instituicao) references instituicao(id)
);

insert into tipo_material(nome, foto_url) values 
("Projector", "projector.jpg"),
("Marcador", "marcador.jpg"),
("Apagador", "apagador.jpg"),
("Flash", "flash.jpeg"),
("Regua", "regua.jpg"),
("Compasso", "compasso.jpg"),
("Tesoura", "tesoura.jpeg"),
("Adaptador", "adaptador.jpg");