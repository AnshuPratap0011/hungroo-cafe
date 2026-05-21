CREATE TABLE settings (

    id INT AUTO_INCREMENT PRIMARY KEY,

    cafe_name VARCHAR(255) NOT NULL,

    email VARCHAR(255) NOT NULL,

    phone VARCHAR(50) NOT NULL,

    address TEXT NOT NULL,

    instagram VARCHAR(255) NULL,

    facebook VARCHAR(255) NULL,

    youtube VARCHAR(255) NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);