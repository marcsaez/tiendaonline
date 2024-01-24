CREATE TABLE admin(
	emailadmin VARCHAR (255),
	passwordadmin VARCHAR (255)
);
-- Crear la tabla Customers
CREATE TABLE Customers (
	email VARCHAR(255) PRIMARY KEY,
	customerPhone INT,
	customerName VARCHAR(255),
	customerSurname VARCHAR(255),
	customerAddress VARCHAR(255),
	customerPassword VARCHAR(255)
);

-- Crear la tabla Purchases
CREATE TABLE Purchases (
	purchaseID SERIAL PRIMARY KEY,
	customerEmail VARCHAR(255) REFERENCES Customers(email),
	status SMALLINT,
	totalCost INT,
	creationDate DATE,
	sendDate DATE
);
-- Crear la tabla Categories
CREATE TABLE Categories (
	categoryID SERIAL PRIMARY KEY,
	categoryName VARCHAR(255),
	fkFatherCategory INT REFERENCES Categories(categoryID) DEFAULT NULL,
	active SMALLINT NOT NULL DEFAULT 1
	
);
-- Crear la tabla Products
CREATE TABLE Products (
	productID VARCHAR(255) PRIMARY KEY,
	productName VARCHAR(255),
	productDescription VARCHAR(255),
	productImg VARCHAR(255),
	productStock INT,
	productNoted SMALLINT,
	productPrice INT,
	fkCategories INT REFERENCES Categories(categoryID),
            active SMALLINT NOT NULL DEFAULT 1
);

-- Crear la tabla Cart
CREATE TABLE Cart (
	cartID SERIAL PRIMARY KEY,
	fkPurchase INT REFERENCES Purchases(purchaseID),
	fkProduct VARCHAR(255) REFERENCES Products(productID),
	amount INT,
	totalPrice INT
);
-- crear la tabla SliderImages
CREATE TABLE sliderImages (
	ID SERIAL PRIMARY KEY,
	numImage INT,
	ruteImage VARCHAR(255)
);
