create table clients (
                         client_id int(11) NOT NULL AUTO_INCREMENT,
                         name varchar(100) COLLATE utf8_polish_ci NOT NULL ,
                         surname varchar(100) COLLATE utf8_polish_ci NOT NULL,
                         email varchar(100) COLLATE utf8_polish_ci NOT NULL UNIQUE,
                         phone_number varchar(100) COLLATE utf8_polish_ci NOT NULL UNIQUE,
                         description varchar(100) COLLATE utf8_polish_ci NOT NULL,
                         PRIMARY KEY (client_id))