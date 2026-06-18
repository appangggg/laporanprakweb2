# Inventory System API v1
Base URL: `http://localhost:8000/api/v1`

## Auth
**POST /register**
* Body: `{ name, email, password, password_confirmation }`
* Response: 201 Created
```json
{
  "success": true,
  "message": "User registered",
  "data": { "user": "...", "token": "..." }
}