CREATE DATABASE IF NOT EXISTS fbook_online
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE fbook_online;

CREATE TABLE users (
  user_id        INT           NOT NULL AUTO_INCREMENT,
  username       VARCHAR(50)   NOT NULL UNIQUE,
  name           VARCHAR(100)  NOT NULL,
  email          VARCHAR(100)  NOT NULL UNIQUE,
  password       VARCHAR(255)  NOT NULL,
  graduation_year YEAR         NOT NULL,
  created_at     DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id)
);

CREATE TABLE sessions (
  session_id    VARCHAR(128)  NOT NULL,
  user_id       INT           NOT NULL,
  ip_address    VARCHAR(45)   NOT NULL,
  session_start DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  session_end   DATETIME      DEFAULT NULL,
  PRIMARY KEY (session_id),
  CONSTRAINT fk_session_user
    FOREIGN KEY (user_id) REFERENCES users(user_id)
    ON DELETE CASCADE
);

CREATE TABLE location (
  location_id  INT           NOT NULL AUTO_INCREMENT,
  place_name   VARCHAR(100)  NOT NULL,
  latitude     DECIMAL(10,7) NOT NULL,
  longitude    DECIMAL(10,7) NOT NULL,
  address      VARCHAR(255)  DEFAULT NULL,
  map_api_id   VARCHAR(100)  DEFAULT NULL,
  PRIMARY KEY (location_id)
);

CREATE TABLE traditions (
  tradition_id   INT           NOT NULL AUTO_INCREMENT,
  tradition_name     VARCHAR(100)  NOT NULL,
  description    TEXT          DEFAULT NULL,
  category       VARCHAR(50)   DEFAULT NULL,
  location_id    INT           DEFAULT NULL,
  fbook_pagenum  SMALLINT      DEFAULT NULL,
  PRIMARY KEY (tradition_id),
  CONSTRAINT fk_tradition_location
    FOREIGN KEY (location_id) REFERENCES location(location_id)
    ON DELETE SET NULL
);

CREATE TABLE completion (
  comp_id      INT      NOT NULL AUTO_INCREMENT,
  user_id      INT      NOT NULL,
  tradition_id INT      NOT NULL,
  caption      TEXT     DEFAULT NULL,
  completed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  is_public    TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (comp_id),
  UNIQUE KEY uq_user_tradition (user_id, tradition_id),
  CONSTRAINT fk_comp_user
    FOREIGN KEY (user_id) REFERENCES users(user_id)
    ON DELETE CASCADE,
  CONSTRAINT fk_comp_tradition
    FOREIGN KEY (tradition_id) REFERENCES traditions(tradition_id)
    ON DELETE CASCADE
);

CREATE TABLE photos (
  photo_id      INT          NOT NULL AUTO_INCREMENT,
  user_id       INT          NOT NULL,
  completion_id INT          DEFAULT NULL,
  tradition_id  INT          DEFAULT NULL,
  file_path     VARCHAR(255) NOT NULL,
  uploaded_at   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (photo_id),
  CONSTRAINT fk_photo_user
    FOREIGN KEY (user_id) REFERENCES users(user_id)
    ON DELETE CASCADE,
  CONSTRAINT fk_photo_completion
    FOREIGN KEY (completion_id) REFERENCES completion(comp_id)
    ON DELETE SET NULL,
  CONSTRAINT fk_photo_tradition
    FOREIGN KEY (tradition_id) REFERENCES traditions(tradition_id)
    ON DELETE SET NULL
);


CREATE INDEX idx_completion_user     ON completion(user_id);


CREATE INDEX idx_completion_tradition ON completion(tradition_id);


CREATE INDEX idx_photo_completion    ON photos(completion_id);
CREATE INDEX idx_photo_tradition     ON photos(tradition_id);