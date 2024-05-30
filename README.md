## Laravel 11 JWT Auth restful API (Backend) using Postman

This project is a backend project with the following functional Software Requirements Specification (SRS):

- **The project includes authentication features (Register, Login, Logout, Me).**
- **The project includes CRUD operations (Create, Read, Update, and Delete) with input validation.**
- **The project includes a Data Search feature.**
- **The project includes a Data Sort feature (Ascending and Descending, with the default being Descending).**
- **The project includes a Data Pagination feature.**

## DUMMY ACCOUNT LOGIN
- email : ujicoba@contoh.com
- password : 123456
  
## How to Use API (Postman)
1. **Run Laravel Project**
2. **Open Postman.**
 - **Use the following link: https://www.postman.com/lunar-module-architect-69335732/workspace/my-workspace/collection/24527267-8462b3c6-102d-43fa-b89e-350f9edaa64b?action=share&creator=24527267**

## **Using the API**
1. **Register:**
- **URL: http://127.0.0.1:8000/api/auth/register (POST)**
- **The register endpoint has several fields:**
a. name (required)
b. email (email|required|unique)
c. password (required)
d. password_confirmation (required)
e. tempat_lahir (string|required)
f. tanggal_lahir (date|yyyy-mm-dd)

2. **Login:**
- **URL: http://127.0.0.1:8000/api/auth/login (POST)**
- **The login endpoint has two fields:**
a. email
b. password

3. **Me:**
- **URL: http://127.0.0.1:8000/api/auth/me (GET)**
- **Use with a token.**

4. **Paginate:**
- **URL: http://127.0.0.1:8000/api/auth/users?paginate={number}&jumlah={number} (GET)**
 **Replace {number} with actual numbers (do not use {}).**
- **paginate specifies the number of pages.**
- **jumlah specifies the number of records per page.**

5. Sort:
- **URL: http://127.0.0.1:8000/api/auth/users?urutkan=id&urutanOrder={order} (GET)**
**Replace {order} with asc (ascending) or desc (descending) to sort the data.**
  
6. Search:
**There are three types of search:**
- **By name: http://127.0.0.1:8000/api/auth/users?nama={name} (GET)**
- **By email: http://127.0.0.1:8000/api/auth/users?email={email} (GET)**
- **By place of birth: http://127.0.0.1:8000/api/auth/users?tempat={place_of_birth} (GET)**

7. Update:
- **URL: http://127.0.0.1:8000/api/auth/users/{id} (PUT)**
- **This endpoint allows you to update data based on the user ID.**
  
8. Delete:
- **URL: http://127.0.0.1:8000/api/auth/users/{id} (DELETE)**
- **This endpoint allows you to delete data based on the user ID.** 

9. Logout:
- **URL: http://127.0.0.1:8000/api/auth/logout?token (POST)**
- **Use this endpoint to logout using a token.**

