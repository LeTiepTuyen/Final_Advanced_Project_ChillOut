# Chillout Shopping for Furniture Items - Database Description

## Overview
This document provides a detailed description of the database schema used in our project. The database is designed to manage addresses, orders, products, and product images, ensuring efficient storage and retrieval of data.

## Team Information
- **Team Name**: Chill out  
- **Project Name**: Chillout Shopping for Furniture Items  

The team "Chill out" is dedicated to developing a seamless and user-friendly shopping experience for furniture items. Our project, "Chillout Shopping for Furniture Items," aims to provide customers with an intuitive platform to browse, select, and purchase furniture with ease.

## Database Hosting and Connectivity

### Hosting
The database is hosted on a PostgreSQL server, a powerful and reliable database system renowned for its advanced features and performance. Database management and administration are handled using **pgAdmin 4**, ensuring seamless monitoring and maintenance of database operations.

### Connectivity
The backend is developed using Laravel, a robust PHP framework. **Eloquent ORM**, Laravel’s built-in Object Relational Mapper, provides an elegant and intuitive interface for interacting with the database. This ensures efficient and secure database operations while adhering to best practices for backend development.

## ER Diagram
The following diagram represents the Entity-Relationship (ER) model of our database:

![ER Diagram](/Database_Description/ER_Diagram.png)

## Schema

### Addresses
| Field      | Type         | Attributes                                   |
| ---------- | ------------ | -------------------------------------------- |
| id         | Integer      | Primary Key, Auto Increment                  |
| user_id    | UUID         | Unique Identifier for the user               |
| name       | String       |                                              |
| address    | String       |                                              |
| zipcode    | String       |                                              |
| city       | String       |                                              |
| country    | String       |                                              |
| created_at | Timestamp    | Default: Current Timestamp                   |
| updated_at | Timestamp    | Default: Current Timestamp                   |

### Orders
| Field      | Type         | Attributes                                   |
| ---------- | ------------ | -------------------------------------------- |
| id         | UUID         | Primary Key                                 |
| user_id    | UUID         | Foreign Key referencing Users               |
| name       | String       |                                              |
| address    | String       |                                              |
| zipcode    | String       |                                              |
| city       | String       |                                              |
| country    | String       |                                              |
| created_at | Timestamp    | Default: Current Timestamp                   |
| updated_at | Timestamp    | Default: Current Timestamp                   |

### Order Items
| Field      | Type         | Attributes                                   |
| ---------- | ------------ | -------------------------------------------- |
| id         | Integer      | Primary Key, Auto Increment                  |
| order_id   | UUID         | Foreign Key referencing Orders               |
| product_id | Integer      | Foreign Key referencing Products             |
| created_at | Timestamp    | Default: Current Timestamp                   |
| updated_at | Timestamp    | Default: Current Timestamp                   |

### Products
| Field             | Type         | Attributes                                   |
| ----------------- | ------------ | -------------------------------------------- |
| id                | Integer      | Primary Key, Auto Increment                  |
| title             | String       |                                              |
| description       | Text         |                                              |
| short_description | String       | Default: Empty                               |
| price             | Integer      |                                              |
| created_at        | Timestamp    | Default: Current Timestamp                   |
| updated_at        | Timestamp    | Default: Current Timestamp                   |

### Product Images
| Field      | Type         | Attributes                                   |
| ---------- | ------------ | -------------------------------------------- |
| id         | Integer      | Primary Key, Auto Increment                  |
| product_id | Integer      | Foreign Key referencing Products             |
| url        | String       |                                              |
| created_at | Timestamp    | Default: Current Timestamp                   |
| updated_at | Timestamp    | Default: Current Timestamp                   |

## Relationships
- **Addresses** and **Orders**: The `user_id` ensures each order is linked to a user's address.
- **Orders** and **Order Items**: Each order can have multiple items, linked through the `order_id`.
- **Order Items** and **Products**: Each order item is associated with a product, linked via the `product_id`.
- **Products** and **Product Images**: Each product can have multiple images, linked through the `product_id`.

## Notes
- The database uses **PostgreSQL** as the provider.  
- Laravel’s Eloquent ORM facilitates seamless interaction with the database.  
- Database migrations are used for version control and schema management.

## Conclusion
This schema provides a robust structure for managing various entities involved in the project, ensuring data integrity and ease of access. Using Laravel and PostgreSQL allows for scalable and efficient backend operations.

