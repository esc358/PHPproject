USE Emilio200478144;

DROP TABLE IF EXISTS abilities;

CREATE TABLE IF NOT EXISTS abilities (
  ability_id INT NOT NULL AUTO_INCREMENT,
  ability VARCHAR(20),
  PRIMARY KEY (ability_id));

INSERT INTO abilities (ability) VALUES 
('strength'),
('intelligence'),
('agility');

SELECT * FROM dota;