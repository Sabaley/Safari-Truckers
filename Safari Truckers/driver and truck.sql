CREATE TABLE drivers (
    driver_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE trucks (
    truck_id INT AUTO_INCREMENT PRIMARY KEY,
    truck_name VARCHAR(100) NOT NULL,
    driver_id INT,
    latitude DOUBLE,
    longitude DOUBLE,
    FOREIGN KEY (driver_id) REFERENCES drivers(driver_id)
);
