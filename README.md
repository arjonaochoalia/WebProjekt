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
) 


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
) 


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


