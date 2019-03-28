CREATE DATABASE fightblog;
USE fightblog;



CREATE TABLE subj (
	id INT UNSIGNED AUTO_INCREMENT,
	title VARCHAR(100) NOT NULL,
	content TEXT NOT NULL,
  img VARCHAR(100) NOT NULL,
	auteur_id INT UNSIGNED NOT NULL,
	date_publication DATETIME NOT NULL,
  category_id INT UNSIGNED NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE user (
	id INT UNSIGNED AUTO_INCREMENT,
	pseudo VARCHAR(100) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE category (
	id INT UNSIGNED AUTO_INCREMENT,
	name VARCHAR(150) NOT NULL,
	PRIMARY KEY(id)
);


CREATE TABLE comment (
	id INT UNSIGNED AUTO_INCREMENT,
	subj_id INT UNSIGNED NOT NULL,
	auteur_id INT UNSIGNED,
	content TEXT NOT NULL,
	date_comment DATETIME NOT NULL,
	PRIMARY KEY(id)
);

-- Clés étrangères
ALTER TABLE subj 
ADD CONSTRAINT fk_subj_category FOREIGN KEY (category_id) REFERENCES category(id),
ADD CONSTRAINT fk_auteur_subj FOREIGN KEY (auteur_id) REFERENCES user(id);



ALTER TABLE comment  
ADD CONSTRAINT fk_subj_com FOREIGN KEY (subj_id) REFERENCES subj(id),
ADD CONSTRAINT fk_auteur_com FOREIGN KEY (auteur_id) REFERENCES user(id);

-- Index
CREATE UNIQUE INDEX index_email
ON user(email);

CREATE UNIQUE INDEX index_pseudo
ON user(pseudo);

CREATE INDEX index_date_subj 
ON subj(date_publication);

CREATE INDEX index_date_comment
ON comment(date_comment);





INSERT INTO category (name) VALUES ('Judo'),('Boxe Anglaise'),('Mma'),('Karaté'),('Muy Thai'),('Jujitsu'),('Lutte'),('Aîkido'),('Boxe Anglaise'),('Boxe Anglaise')

INSERT INTO user (pseudo) VALUES ('imedsa');

INSERT INTO subj (title,content,img,auteur_id,date_publication,category_id) VALUES ("Turkish athlete wins bronze",'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit unde rerum quidem voluptates asperiores officia impedit id beatae expedita labore ut neque reiciendis ducimus pariatur eveniet, eius aut voluptatem perspiciatis?' , 'turkish.jpg', 1 , '2019/01/23' , 1);

INSERT INTO comment (subj_id,auteur_id,content,date_comment) VALUES ( 4 , 1 , 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit unde rerum quidem voluptates asperiores officia impedit id beatae expedita labore ut neque reiciendis ducimus pariatur eveniet, eius aut voluptatem perspiciatis?', '2019/01/22''12:05:23');
