# The Database Design 
- [Business  Rules](#business-rules)
- [Entity Relationship Diagram](#entity-relationship-diagram-erd)

## Business Rules

1. ### Admin
    - **Properties:**
        - Admin has a full name, email and password.
        - Admin manages the posts, users, questions, answers and payments.
        - Admin can create, edit, delete posts.
    - **Uniqueness:**
        - Admin's email should be unique.
    - **Mandatory & Optional:**
        - **Mandatory:** Admin's email, first name, last name, and password should be mandatory.
        - **Optional:** Admin's profile image.
    - **Relationship:**
        - Admin manages many users.
        - Admin manages many payment.
        - Admin uploads many food posts.
2. ### User
    - **Properties:**
        - A user has a username, first name, last name, address, email, image, role and password.
        - A user can be a premium user or a regular user.
        - A user can like, give review, share, bookmark, and ask questions.
        - A premium user makes payment to upload valid food posts.
        - A premium user can post their favorite foods while a regular user cannot.
        - A user can view food's post by admin and premium users.
        - A user gets notification of all the newly uploaded posts, and replies to their questions.
    - **Uniqueness:**
        - Each user must have unique username and email. 
    - **Mandatory & Optional:**
        - **Mandatory:** username, email, first name, last name, address and password.
        - **Optional:**  profile image.
    - **Relationship:**
        - A user can review many food posts.
        - A user can like many food posts.
        - A user can bookmark many food posts.
        - A user can ask many questions.
        - A premium user can have many posts. 
3. ### Restaurant
    - **Properties:**
        -  A restaurant has name, location, and phone number.
        -  A restaurant contains many foods.
    - **Uniqueness:**
        - Each restaurant's phone number should be unique. 
    - **Mandatory & Optional:**
        - **Mandatory:** name, location and phone number.
    - **Relationship:**
        - A restaurant has many foods.
        - A restaurant belongs to a location.
4. ### Food Category
    - **Properties:**
        - Food category has name. 
    - **Mandatory & Optional:**
        - **Mandatory:** name
    - **Relationship:**
        -  A food category contains many foods.
5. ### Food
    - **Properties:**
        - A food has name, description, price, restaurant, rating, comment, like count, image, created_at and location.
        - A food is categorized under many food categories.
        - A food post contain its name, description(optional), price, image, location, restaurant name a timestamp for when it was created.
    - **Uniqueness:**
        - none 
    - **Mandatory & Optional:**
        - **Mandatory:** name, location, price, restaurant, image, and rating.
        - **Optional:**  description
    - **Relationship:**
        - Many food belongs to one restaurant.
        - A food is categoeized under many food category.
        - A food can have many likes.
        - A food can have many reviews.
        - A food can be bookmarked.
        - A food can be liked by many users.
        - A food can be review by many users.
6. ### Location
    - **Properties:**
        - A location has address, city, and province. 
    - **Uniqueness:**
    - **Mandatory & Optional:**
        - **Mandatory:** address, city, and province.
    - **Relationship:**
        - A location can have many restaurants. 
7. ### Like
    - **Properties:**
        -  Like has it like_id, food_id, and user_id.
    - **Mandatory & Optional:**
        - **Mandatory:** like_id, food_id, and user_id.
    - **Relationship:**
        - Many likes belongs to one food.
        - Many likes are done by one user.
8. ### Review
    - **Properties:**
        - A review has review_id, rating, comment, created_at, user_id, and food_id.
        - A review has a content (250 characters) and a timestamp for when it was created. 
    - **Uniqueness:**
    - **Mandatory & Optional:**
        - **Mandatory:** rating
        - **Optional:** comment
    - **Relationship:**
        - Many reviews can be done by one user.
        - Many reviews belongs to one food. 
9. ### Bookmark
    - **Properties:**
        -  
    - **Mandatory & Optional:**
        - **Mandatory:** rating
        - **Optional:** comment
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
