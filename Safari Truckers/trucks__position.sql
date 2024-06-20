CREATE TABLE truck_positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    truck_id VARCHAR(50) NOT NULL,
    latitude FLOAT NOT NULL,
    longitude FLOAT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
