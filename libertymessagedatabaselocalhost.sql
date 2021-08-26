#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

DROP DATABASE IF EXISTS libertymessage;
CREATE DATABASE IF NOT EXISTS libertymessage DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE libertymessage;

#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        idUser           Int  Auto_increment  NOT NULL ,
        userName         Varchar (50) NOT NULL ,
        userPass         Varchar (300) NOT NULL ,
        userStatus       Enum ("logged","nologged") NOT NULL ,
        userDateCreate   DATETIME ,
        userDateDelete   DATETIME ,
        userConnectToken Varchar (100) ,
        numberConnect INT 
	,CONSTRAINT user_PK PRIMARY KEY (idUser)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: room
#------------------------------------------------------------

CREATE TABLE room(
        idRoom              Int  Auto_increment  NOT NULL ,
        roomName            Varchar (100) ,
        roomDateCreate      DATETIME NOT NULL ,
        roomDateLastMessage DATETIME ,
        userNameA           Varchar (50) NOT NULL ,
        idUserA             Int NOT NULL ,
        userNameB           Varchar (50) NOT NULL ,
        idUserB             Int NOT NULL
	,CONSTRAINT room_PK PRIMARY KEY (idRoom)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: message
#------------------------------------------------------------

CREATE TABLE message(
        idMessage         Int  Auto_increment  NOT NULL ,
        messageDateCreate DATETIME NOT NULL ,
        author            Varchar (50) ,
        messageText       Text ,
        idUser            Int NOT NULL ,
        idRoom            Int NOT NULL
	,CONSTRAINT message_PK PRIMARY KEY (idMessage)

	,CONSTRAINT message_user_FK FOREIGN KEY (idUser) REFERENCES user(idUser)
	,CONSTRAINT message_room0_FK FOREIGN KEY (idRoom) REFERENCES room(idRoom)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: access
#------------------------------------------------------------

CREATE TABLE access(
        idRoom Int NOT NULL ,
        idUser Int NOT NULL
	,CONSTRAINT access_PK PRIMARY KEY (idRoom,idUser)

	,CONSTRAINT access_room_FK FOREIGN KEY (idRoom) REFERENCES room(idRoom)
	,CONSTRAINT access_user0_FK FOREIGN KEY (idUser) REFERENCES user(idUser)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Add constraint
#------------------------------------------------------------

ALTER TABLE `message` 
DROP FOREIGN KEY `message_room0_FK`; 
ALTER TABLE `message` ADD CONSTRAINT `message_room0_FK` 
FOREIGN KEY (`idRoom`) REFERENCES `room`(`idRoom`) 
ON DELETE CASCADE ON UPDATE CASCADE; 
ALTER TABLE `message` DROP FOREIGN KEY `message_user_FK`; 
ALTER TABLE `message` ADD CONSTRAINT `message_user_FK` 
FOREIGN KEY (`idUser`) REFERENCES `user`(`idUser`) 
ON DELETE CASCADE ON UPDATE CASCADE; 

ALTER TABLE `access` 
DROP FOREIGN KEY `access_room_FK`; 
ALTER TABLE `access` ADD CONSTRAINT `access_room_FK` 
FOREIGN KEY (`idRoom`) REFERENCES `room`(`idRoom`) 
ON DELETE CASCADE ON UPDATE CASCADE; 
ALTER TABLE `access` DROP FOREIGN KEY `access_user0_FK`; 
ALTER TABLE `access` ADD CONSTRAINT `access_user0_FK` 
FOREIGN KEY (`idUser`) REFERENCES `user`(`idUser`) 
ON DELETE CASCADE ON UPDATE CASCADE; 

#------------------------------------------------------------
# Data supp
#------------------------------------------------------------

INSERT INTO `user` (
`idUser`, 
`userName`, 
`userPass`, 
`userStatus`, 
`userDateCreate`, 
`userDateDelete`, `userConnectToken`
) VALUES (
NULL, 
'Profil supprimé', 
'$2y$10$1/J2erueYgBzfsDUNvSu4u1Vl2tSeQVJRLTyaf24GwdA3Fl0lTe2S', 
'nologged', 
NULL, NULL, NULL);
