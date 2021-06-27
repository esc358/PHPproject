
USE Emilio200478144;

DROP TABLE IF EXISTS dota;

CREATE TABLE IF NOT EXISTS dota (
  dota_id INT NOT NULL AUTO_INCREMENT,
  player VARCHAR(50),
  level INT,
  ability VARCHAR(32),
  comments VARCHAR(100),
  PRIMARY KEY (dota_id));
  
INSERT INTO dota (player, level, ability, comments) VALUES 
('Emilio',19,'Strength','I have been playing dota for many years'),
('Juan', 10, 'Intelligence', 'I have been playing for 3 years'),
('Sebastian', 1, 'Agility', 'I started playing');

SELECT * FROM dota;