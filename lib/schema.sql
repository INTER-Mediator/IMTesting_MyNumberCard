SET NAMES 'utf8mb4';
USE mynumber_db;

CREATE TABLE chat
(
    id        INT AUTO_INCREMENT,
    user      VARCHAR(64),
    groupname VARCHAR(64),
    postdt    DATETIME,
    message   VARCHAR(800),
    PRIMARY KEY (id)
) CHARACTER SET utf8mb4,
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;


CREATE TABLE fileupload
(
    id   INT AUTO_INCREMENT,
    f_id INT,
    path VARCHAR(1000),
    PRIMARY KEY (id)
) CHARACTER SET utf8mb4,
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;

CREATE TABLE authuser
(
    id              INT AUTO_INCREMENT,
    username        VARCHAR(64),
    hashedpasswd    VARCHAR(72),
    realname        VARCHAR(100),
    email           VARCHAR(100),
    address         VARCHAR(200),
    birthdate       CHAR(8),
    gender          CHAR(1),
    sub             VARCHAR(255),
    limitdt         DATETIME,
    initialPassword VARCHAR(30),
    PRIMARY KEY (id)
) CHARACTER SET utf8mb4,
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;

CREATE INDEX authuser_username
    ON authuser (username);
CREATE INDEX authuser_email
    ON authuser (email);
CREATE INDEX authuser_limitdt
    ON authuser (limitdt);

INSERT
authuser
SET id=1,
    `username`='admin',
    hashedpasswd='7b4bfc43a2fdbaba4dba693510c1ff36be5353f636429cdd676e816dc7a0189b4e616b6a',
    email='msyk@msyk.net';

CREATE TABLE authgroup
(
    id        INT AUTO_INCREMENT,
    groupname VARCHAR(48),
    PRIMARY KEY (id)
) CHARACTER SET utf8mb4,
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;

CREATE TABLE authcor
(
    id            INT AUTO_INCREMENT,
    user_id       INT,
    group_id      INT,
    dest_group_id INT,
    privname      VARCHAR(48),
    PRIMARY KEY (id)
) CHARACTER SET utf8mb4,
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;

CREATE INDEX authcor_user_id
    ON authcor (user_id);
CREATE INDEX authcor_group_id
    ON authcor (group_id);
CREATE INDEX authcor_dest_group_id
    ON authcor (dest_group_id);

CREATE TABLE issuedhash
(
    id         INT AUTO_INCREMENT,
    user_id    INT,
    clienthost VARCHAR(64),
    hash       VARCHAR(100),
    expired    DateTime,
    PRIMARY KEY (id)
) CHARACTER SET utf8mb4,
  COLLATE utf8mb4_unicode_ci
  ENGINE = InnoDB;

CREATE INDEX issuedhash_user_id
    ON issuedhash (user_id);
CREATE INDEX issuedhash_expired
    ON issuedhash (expired);
CREATE INDEX issuedhash_clienthost
    ON issuedhash (clienthost);
CREATE INDEX issuedhash_user_id_clienthost
    ON issuedhash (user_id, clienthost);

