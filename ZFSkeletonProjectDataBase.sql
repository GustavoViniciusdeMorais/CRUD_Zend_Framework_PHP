
/* mysql:dbname=data */
create database data;

CREATE TABLE album (
	id INT PRIMARY KEY AUTO_INCREMENT, 
	artist varchar(100) NOT NULL, 
	title varchar(100) NOT NULL
);

CREATE TABLE certification (
	id INT PRIMARY KEY AUTO_INCREMENT, 
	title varchar(100) NOT NULL, 
	text TEXT NOT NULL
);

INSERT INTO certification (title, text) VALUES ('Zend Certified Engineer', 'Gustavo is an expert in the PHP programming language');
INSERT INTO certification (title, text) VALUES ('ITIL Foundation', 'Information Technology Infrastructure Library');
UPDATE certification SET title='Zend Certified Engineer', text='Gustavo is expert in PHP' WHERE id = 1;

INSERT INTO album (artist, title) VALUES ('The Military Wives', 'In My Dreams');
INSERT INTO album (artist, title) VALUES ('Adele', '21');
INSERT INTO album (artist, title) VALUES ('Bruce Springsteen', 'Wrecking Ball (Deluxe)');
INSERT INTO album (artist, title) VALUES ('Lana Del Rey', 'Born To Die');
INSERT INTO album (artist, title) VALUES ('Gotye', 'Making Mirrors');