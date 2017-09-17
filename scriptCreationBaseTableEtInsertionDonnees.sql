CREATE DATABASE IF NOT EXISTS Banque;
CREATE TABLE IF NOT EXISTS Banque.users
(
    id VARCHAR(20) PRIMARY KEY NOT NULL,
    login VARCHAR(40) NOT NULL,
    pass VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS Banque.accounts
(
	id VARCHAR(40) PRIMARY KEY NOT NULL,
	idUsers VARCHAR(20) NOT NULL,
	type VARCHAR(30) NOT NULL,
	amount DECIMAL
);

CREATE TABLE IF NOT EXISTS Banque.tableToDelete
(
	id VARCHAR(40) PRIMARY KEY NOT NULL
);

INSERT INTO `Banque`.`tableToDelete` VALUES ('123456'),('234567'),('345678');

INSERT INTO`Banque`.`users` (`id`,`login`,`pass`) VALUES ('123456','Alphonse Didle','alphonse'),('234567','Gertrude Stuart','ilovemummy');

INSERT INTO `Banque`.`accounts` (`id`,`idUsers`,`type`,`amount`) VALUES ('987654321','123456','CC','2186.18'),('123456789','123456','CEL','5000.00'),('987456321','123456','LivretJeune','4000.00'),('963258741','234567','CC','541.23'),('654321987','234567','CEL','9874.00');
