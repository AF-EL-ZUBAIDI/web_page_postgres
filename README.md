# Web Page with Postgres

This project demonstrates setting up a PostgreSQL database and exposing it through a web interface using PostgREST.

## Why do we choose PostgreSQL and PostgREST?
We chose PostgreSQL and PostgREST for their synergy in creating efficient web applications. PostgreSQL provides a robust and versatile database system, ideal for complex data handling. Coupled with PostgREST, it allows us to effortlessly turn our database into a RESTful API, streamlining backend development. This setup emphasizes simplicity and effectiveness, enabling us to focus on building features without getting bogged down in technical complexities.

## Technologies and Tools Used
- **PostgreSQL:** An advanced open-source relational database that supports both SQL (relational) and JSON (non-relational) querying.

- **PostgREST:** A standalone web server that turns your PostgreSQL database directly into a RESTful API. It provides a more straightforward and cleaner way of building APIs over direct database access.

- **Homebrew:** A package manager for macOS used for installing PostgreSQL and PostgREST.

- **SQL (Structured Query Language):** Used to communicate with the database, perform various operations on data, create and manipulate database structures.

This setup is ideal for projects that require a robust backend database and wish to quickly provide web-based access without extensive backend development.


## Installation and Setup
### Step 1: Install and Start PostgreSQL

1. Install PostgreSQL:
```bash
brew install postgresql
```

2. Start PostgreSQL:
```bash
brew services start postgresql
```


### Step 2: Create and Setup Database

3. Create a New Database:
- Open Terminal and connect to PostgreSQL:
```bash
psql postgres
```

4. Create a new database:
```sql
CREATE DATABASE myproject;
```
- Exit psql with `\q`.



Step 2: Designing the Database Schema
5. Connect to Your Database:
```bash
psql myproject
```

6. Create Tables:
```sql
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
);
```
--------
Step 3: Populate Database with Sample Data

7. Insert Sample Data:
- Insert data into the `users` table:
```sql
INSERT INTO users (name, email) VALUES ('Alice', 'alice@example.com');
```

Step 4: Installing and Configuring PostgREST
8. Install PostgREST:
```bash
brew install postgrest
```

9. Configure PostgREST:
- Create a configuration file, postgrest.conf, with the following content:
```bash
db-uri = "postgres://user:yourpassword@localhost:5432/myproject"
db-schema = "public"
db-anon-role = "web_user"
```

- Replace user and yourpassword with your PostgreSQL credentials.
- If unsure about credentials, check with:
```bash
psql postgres
\du
```

10. Set or reset the password if needed:
```sql
ALTER ROLE yourrole WITH PASSWORD 'newpassword';
```

11 .Create the web_user Role:
-In PostgreSQL terminal:
```sql
CREATE ROLE web_user NOLOGIN;
```

12. Grant Necessary Permissions:
- Connect to the database:
```bash
psql -U yourrole -d myproject
```
- Grant permissions:
```sql
GRANT USAGE ON SCHEMA public TO web_user;
GRANT SELECT ON TABLE users TO web_user;
```

-Optionally, grant all privileges (be cautious with this in a production environment):
```sql
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO yourrole;
```

13. Restart PostgREST:
```bash
postgrest postgrest.conf
```

### Testing the API
- Access the API by navigating to http://localhost:3000/users.
- You should see output similar to 
![Alt text](images/result.png)

