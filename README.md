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
