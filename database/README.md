# The Database Design 
- [Business  Rules](#business-rules)
- [Entity Relationship Diagram](#entity-relationship-diagram-erd)

## Business Rules


1. ### Admin
    - **Properties:**
        - Admin has a full name, email and password.
        - Admin manages the posts, users, questions and answers and payments.
        - Admin can create, edit, delete posts.
    - **Uniqueness:**
        - Admin's email should be unique.
    - **Mandatory & Optional:**
        - Mandatory: Admin's email and first name should be mandatory.
    - **Relationship:**
        - Admin manages multiple users.
        - Admin manages payment.
        - Admin uploads food posts.
2. ### User
    - **Properties:**
        - A user has a username, email, password. 
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
3. ### Restaurant
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
4. ### Food
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
5. ### Food Category
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
6. ### Location
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
7. ### Like
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
8. ### Review
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
9. ### Bookmark
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
10. ### Post
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
11. ### Comment
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
12. ### Payment
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
13. ### Question
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**
14. ### Answer
    - **Properties:**
    - **Uniqueness:**
    - **Mandatory & Optional:**
    - **Relationship:**

## Entity Relationship Diagram (ERD)
