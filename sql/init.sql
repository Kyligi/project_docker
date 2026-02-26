CREATE TABLE IF NOT EXISTS messages (
	id INT AUTO_INCREMENT PRIMARY KEY,
	texte VARCHAR(255) NOT NULL
);

INSERT INTO messages (texte) VALUES ('Message auto de test');
