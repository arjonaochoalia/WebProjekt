Web project by Lia and Supjan

Database:

CREATE TABLE users (
    user_id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_role VARCHAR(50) DEFAULT 'user',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id),
    UNIQUE KEY username (username),
    UNIQUE KEY email (email)
);


CREATE TABLE events (
    event_id INT(11) NOT NULL AUTO_INCREMENT,
    admin_id INT(11) NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT DEFAULT NULL,
    location VARCHAR(255) DEFAULT NULL,
    event_date DATE DEFAULT NULL,
    event_time TIME DEFAULT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (event_id),
    KEY admin_id (admin_id)
);

CREATE TABLE user_events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    liked BOOLEAN DEFAULT FALSE,
    participating BOOLEAN DEFAULT FALSE,
    UNIQUE (user_id, event_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE
);





Example Events for testing purposes:


INSERT INTO events (admin_id, title, description, location, event_date, event_time, image_path)
VALUES
(3, 'Kunst-Workshop für Erwachsene', 
'Entdecken Sie Ihre kreative Seite bei unserem Kunst-Workshop für Erwachsene. Unter Anleitung erfahrener Künstler können Sie Maltechniken ausprobieren und Ihr eigenes Kunstwerk gestalten. Alle Materialien werden gestellt.', 
'Kunsthalle Wien, 1010 Wien', 
'2025-05-10', '14:00:00', 'Bilder/kunstworkshop.jpg');


INSERT INTO events (admin_id, title, description, location, event_date, event_time, image_path)
VALUES
(3, 'Lauftreff im Prater', 
'Treffen Sie Gleichgesinnte und genießen Sie gemeinsam eine Lauf-Runde durch den Wiener Prater. Anfänger und Fortgeschrittene sind willkommen. Treffpunkt ist der Haupteingang. Bitte Sportschuhe und Wasser mitbringen.', 
'Wiener Prater, 1020 Wien', 
'2025-06-22', '08:00:00', 'Bilder/lauftreff.jpg');

--NEW

-- Users

INSERT INTO users (user_id, username, first_name, last_name, email, user_password, user_role, created_at)
VALUES 
(1, 'lia_1230', 'Lia', 'Arjona', 'arjona.lia05@gmail.com', '$2y$10$sLI8trAhpgJNG3lQJw3w5..UzcrAH9zB4r/tyw7Y.q9Cn3tPfAOiK', 'admin', '2025-11-13 16:57:39'),
(2, 'max_musterman', 'Max', 'Mustermann', 'max.mustermann@gmail.com', '$2y$10$Mu8Wsk9NwUdTfpJ0jhghgOPRpDpX.nOJUnGZMuOZHd4pBJeCtGNOG', 'user', '2025-11-16 22:32:24');


-- Events

INSERT INTO events (event_id, admin_id, title, description, location, event_date, event_time, image_path, created_at)
VALUES 
(3, 1, 'Facials Workshop', 'Learn the fundamentals of professional facial treatments and pamper your skin. From cleansing and exfoliation to massage techniques – explore different methods suitable for every skin type. Please bring a towel and wear comfortable clothing. Beginners are warmly welcome.', NULL, '2025-11-23', '14:30:00', 'Bilder/691a3a579193e_facials_workshop.jpg', '2025-11-16 21:55:51'),
(4, 1, 'Lash Extension Workshop', 'Learn professional techniques for flawless eyelash extensions and stunning looks. In this workshop, you will practice applying extensions, proper aftercare, and tips for long-lasting results. Bring a steady hand, attention to detail, and curiosity – beginners are warmly welcome.', NULL, '2025-12-12', '09:10:00', 'Bilder/691a3d7498254_lash_extension_workshop.jpg', '2025-11-16 22:09:08');

-- Reviews

CREATE TABLE reviews ( review_id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, content TEXT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP, FOREIGN KEY (user_id) REFERENCES users(user_id) );

