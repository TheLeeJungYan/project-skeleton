<!-- # Project Skeleton

This repository contains the project skeleton which is run with Docker.

## System Requirements

- Docker ^4.x
- Default ports [8100 (app) and 3400 (DB)] must be available, otherwise, it needs adjustment on the exposed ports.

## Setup

- Copy environment files by running `cp .env.example .env`.
- Run `docker-compose up -d`.
- If there are no issues, your app should run `http://localhost:8100`.
- Your database should run on port `3400`. Here are the default credentials:

```
HOST=localhost
PORT=3400
USERNAME=root
PASSWORD=aypgroup
``` -->

# Worker Employment Histories API

## 1. Extra Work and Its Importance

-   **Custom Error Handling:** I have implemented error handling for all API endpoints to ensure that error responses are consistent and easy to understand. This helps to maintain a uniform response format, which simplifies error tracking and debugging.This ensure clients receive meaningful feedback when something goes wrong.

-   **Optimized Database Queries:** Several database queries have been optimized using eager loading relationships to prevent N+1 query problems. This ensures faster response times and scalability when handling a large number of workers and employment history records.

-   **Test Cases for Success Response:** I created test cases to validate the success scenarios for API endpoints. The tests ensure that the system correctly handles the expected responses.

-   **Middleware for Ensuring JSON Requests:** A middleware was created to ensure that all incoming requests are in JSON format. This helps guarantee that the API consistently receives data in the correct format, preventing issues caused by invalid input.

-   **Logging with JSON Format and Daily Rotation:** I implemented logging that outputs in JSON format, making it easy to parse and analyze logs programmatically. The logs are rotated daily, ensuring that logs are manageable and don't grow too large over time.

-   **Seeder for Testing Purposes:** I created a seeder to populate the database with test data. This is useful for running tests in a controlled environment and ensuring that the application behaves as expected when interacting with a populated database.

-   **Resource Class for API Response Formatting:** A resource class was implemented to format the data returned by the "Get Worker" API. This ensures that the API response is consistent and follows a clear structure, making it easier for clients to consume the data.

-   **Reusable Response Class for Standardized Error and Success Responses:** A reusable response class was implemented to return standardized success and error responses across the API. This class ensures that all responses, whether successful or erroneous, follow a consistent format, making the API easier to interact with and maintain.

-   **Custom Exception for Employment History Assignment:** I created a custom exception to handle the scenario where a new employment history cannot be assigned to a worker who is still actively employed. This exception ensures that the business logic of the application is respected, preventing invalid data from being inserted into the system.

-   **Request Class for Input Validation:** I created custom Request Classes that handle validation logic for incoming requests. By organizing validation logic in these dedicated classes, I ensured that the code is clean, modular, and easy to maintain.

---

## 2. Overview of Database Design

### **1. Workers Table:**

-   **Columns:**

    -   `id` (Primary Key)
    -   `firstName`
    -   `lastName`
    -   `email` (Unique)

-   **Reason for Design:** The `Workers` table stores the basic information about each worker. The `email` column is unique to ensure no duplicate worker entries are allowed based on email addresses.

### **2. Employment History Table:**

-   **Columns:**

    -   `id` (Primary Key)
    -   `workerId` (Foreign Key to Workers)
    -   `companyName`
    -   `jobTitle`
    -   `startDate`
    -   `endDate` (Nullable)

-   **Reason for Design:** The `Employment History` table tracks the history of each worker's employment. The `endDate` is nullable, as a `null` value indicates that the worker is still employed. The `worker_id` is a foreign key that associates each employment record with a specific worker.

**Why `workerId` is used instead of `email`:**

-   The `workerId` is a stable and immutable primary key, while the `email` field can be subject to change over time. Using `workerId` ensures that the relationship between a worker and their employment history remains intact even if the worker changes their email address.
-   Using a numeric `workerId` improves database performance over using a string-based `email`, as integers are more efficient for indexing and querying.
-   This approach helps maintain a clean and normalized database schema by avoiding the redundancy of storing `email` in multiple tables.

### **Relationships:**

-   A **worker** can have multiple **employment history** records (One-to-Many relationship).
-   The `workerId` column in the `Employment History` table is a foreign key that references the `id` of the `Workers` table.

---

## 3. Additional Setup

No additional setup is required beyond what has already been outlined. However, you can run the following command to populate your database with test data:

```bash
php artisan db:seed
```

### orginal setup:

#### System Requirements

-   Docker ^4.x
-   Default ports [8100 (app) and 3400 (DB)] must be available, otherwise, it needs adjustment on the exposed ports.

#### Setup

-   Copy environment files by running `cp .env.example .env`.
-   Run `docker-compose up -d`.
-   If there are no issues, your app should run `http://localhost:8100`.
-   Your database should run on port `3400`. Here are the default credentials:

```
HOST=localhost
PORT=3400
USERNAME=root
PASSWORD=aypgroup
```

---

## 4. Additional Assumption

No additional assumption made

---
