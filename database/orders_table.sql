CREATE TABLE orders (

    id INT AUTO_INCREMENT PRIMARY KEY,

    customer_name VARCHAR(255) NOT NULL,

    customer_phone VARCHAR(50) NOT NULL,

    customer_email VARCHAR(255) NULL,

    address TEXT NOT NULL,

    city VARCHAR(255) NOT NULL,

    payment_method VARCHAR(100) NOT NULL,

    subtotal DECIMAL(10,2) NOT NULL,

    delivery_charge DECIMAL(10,2) DEFAULT 49,

    total_amount DECIMAL(10,2) NOT NULL,

    order_status VARCHAR(50) DEFAULT 'pending',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);