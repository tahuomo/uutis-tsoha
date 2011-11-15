drop table kommentti;
drop table uutinen;
drop table luokka;
drop table yllapitaja;


create table luokka (
	luokka_id serial primary key,
	nimi varchar(40)
);

create table yllapitaja (
	yllapitaja_id serial primary key,
	kayttajanimi varchar(30) not null,
	salasana varchar(16) not null
);

create table uutinen (
	uutis_id serial primary key,
	otsikko varchar(80) not null,
	leipa text not null,
	lisaysaika timestamp,
	muokkausaika timestamp,
	muokkaussyy varchar(100),
	luokka int references luokka (luokka_id),
	lisaaja int references yllapitaja (yllapitaja_id)
);

create table kommentti (
	kommentti_id serial primary key,
	nimimerkki varchar(30) not null,
	teksti text not null,
	uutis_id int references uutinen (uutis_id)
);
