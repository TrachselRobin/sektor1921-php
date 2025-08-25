DROP DATABASE IF EXISTS client_sektor1921;
CREATE DATABASE client_sektor1921;
USE client_sektor1921;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE zip (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    postalCode VARCHAR(10) NOT NULL,
    place VARCHAR(30) NOT NULL
);

CREATE TABLE address (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    street VARCHAR(50) NOT NULL,
    houseNumber VARCHAR(10) NOT NULL,
    zipID INT NOT NULL,
    FOREIGN KEY (zipID) REFERENCES zip(ID)
);

CREATE TABLE role (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(30) NOT NULL
);

INSERT INTO role (name) VALUES ('user');
INSERT INTO role (name) VALUES ('moderator');
INSERT INTO role (name) VALUES ('administrator');

CREATE TABLE category (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(50) NOT NULL
);

INSERT INTO category (name) VALUES ('Ticket');
INSERT INTO category (name) VALUES ('Kleidung');
INSERT INTO category (name) VALUES ('Accessoires');

CREATE TABLE `user` (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    surname VARCHAR(30) NOT NULL,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    addressID INT,
    addressDeliveryID INT,
    roleID INT NOT NULL DEFAULT 1,
    member BOOLEAN,
    memberNumber INT,
    memberSince DATE,
    memberUntil DATE,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (addressID) REFERENCES address(ID),
    FOREIGN KEY (addressDeliveryID) REFERENCES address(ID),
    FOREIGN KEY (roleID) REFERENCES role(ID)
);

INSERT INTO user (surname, name, email, password)
VALUES ('Max', 'Muster', 'max.muster@muster.ch', 'b96f3d0265f30f511a27b1e82deefe2bd7ba1d3ae972950aabac34a85b911aba'); -- Passwort (wird zu sha256): MusterPasswort

CREATE TABLE product (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    discount DECIMAL(10,2),
    stock INT,
    categoryID INT NOT NULL,
    visible BOOLEAN DEFAULT true NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (categoryID) REFERENCES category(ID)
);

INSERT INTO product (name, description, price, discount, stock, categoryID, visible)
VALUES ('HCD Pullover', 'Pullover von höchster Qualität mit Logo von Deinem Eishockeyclub.', 59.95, 0.2, 15, 2, true);

CREATE TABLE ticket (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT,
    visible BOOLEAN DEFAULT true NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO ticket (name, description, date, time, price, stock, visible)
VALUES ('CarTicket - SpenglerCup', 'Dieses Ticket lässt Dich bei der Fahrt von Zürich nach Davos im Fan-Car mitfahren.', '2025-12-26', '08:00:00', 15.00, 40, true);

CREATE TABLE `order` (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    userID INT NOT NULL,
    addressDeliveryID INT,
    totalPrice DECIMAL(10,2) NOT NULL,
    status ENUM('In Bearbeitung', 'Versendet', 'Abgebrochen') DEFAULT 'In Bearbeitung',
    isPickup BOOLEAN NOT NULL,
    pickupCode VARCHAR(255) UNIQUE,
    pickupConfirmed BOOLEAN,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (userID) REFERENCES user(ID),
    FOREIGN KEY (addressDeliveryID) REFERENCES address(ID)
);

CREATE TABLE order_product (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    orderID INT NOT NULL,
    productID INT NOT NULL,
    quantity INT DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    discount DECIMAL(10,2),
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (orderID) REFERENCES `order`(ID),
    FOREIGN KEY (productID) REFERENCES product(ID)
);

CREATE TABLE order_ticket (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    orderID INT NOT NULL,
    ticketID INT NOT NULL,
    quantity INT DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    scanned BOOLEAN DEFAULT 1,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (orderID) REFERENCES `order`(ID),
    FOREIGN KEY (ticketID) REFERENCES ticket(ID)
);

CREATE TABLE image (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    productID INT NOT NULL,
    imagePath VARCHAR(255) NOT NULL,
    isMain BOOLEAN DEFAULT false,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (productID) REFERENCES product(ID)
);

CREATE TABLE review (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    productID INT NOT NULL,
    userID INT NOT NULL,
    rating INT NOT NULL,
    comment TEXT,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (productID) REFERENCES product(ID),
    FOREIGN KEY (userID) REFERENCES user(ID)
);

CREATE TABLE payment (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    userID INT NOT NULL,
    orderID INT NOT NULL,
    stripeID VARCHAR(100) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    currency VARCHAR(10),
    status ENUM('succeeded', 'failed', 'pending'),
    type ENUM('membership', 'product', 'ticket'),
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (userID) REFERENCES user(ID),
    FOREIGN KEY (orderID) REFERENCES `order`(ID)
);

CREATE TABLE refresh_token (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    userID INT NOT NULL,
    token TEXT NOT NULL,
    expiresAt TIMESTAMP NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (userID) REFERENCES user(ID)
);

CREATE TABLE cms_content (
    ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `key` VARCHAR(100) NOT NULL,
    value JSON NOT NULL,
    type ENUM('text', 'image') NOT NULL,
    updatedBy INT NOT NULL,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
    FOREIGN KEY (updatedBy) REFERENCES user(ID)
);