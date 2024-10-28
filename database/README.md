# The Database Design 
- [Business  Rules](#business-rules)
- [Entity Relationship Diagram](#entity-relationship-diagram-erd)

## Business Rules

1. ### Admin
    - **Properties:**
        - Admin has a full name, email and password.
        - Admin manages the posts, users, questions, answers and payments.
        - Admin can create, edit, delete.
    - **Uniqueness:**
        - Admin's email should be unique.
    - **Mandatory & Optional:**
        - **Mandatory:** Admin's email, first name, last name, and password should be mandatory.
        - **Optional:** Admin's profile image.
    - **Relationship:**
        - Admin &harr; User: Admin manages many users.
        - Admin &harr; Payment: Admin manages many payment.
        - Admin &harr; Food: Admin uploads many food posts.
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
        - User &harr; Review: A user can write many reviews. This is a **one-to-many** relationship. 
        - User &harr; Like: A user can like many food posts. This is a **one-to-many** relationship.
        - User &harr; Bookmark: A user can bookmark many food posts. This is a **one-to-many** relationship.
        - User &harr; Question: A user can ask many questions. This is a **one-to-many** relationship.
        - A premium user can upload many food posts.
3. ### Restaurant
    - **Properties:**
        -  A restaurant has name, phone_number, email, location_id, website_link, open_time, and close_time.
        -  A restaurant contains many foods.
    - **Uniqueness:**
        - Each restaurant's phone number should be unique. 
    - **Mandatory & Optional:**
        - **Mandatory:** name, location and phone number.
        - **Optional:** website
    - **Relationship:**
        - Restaurant &harr; Food: A restaurant has many foods.
        - Restaurant &harr; Location: A restaurant belongs to a location.
4. ### Food Category
    - **Properties:**
        - Food category has name.
        - Each food are assigned to one or many categtories to make it easy for users to browse.
    - **Uniqueness:**
        - Each category name should be unique. 
    - **Mandatory & Optional:**
        - **Mandatory:** name
    - **Relationship:**
        - Food Category &harr; Food:  Food category contains many foods, and a food can belong to many categories.This is a **many-to-many** relationship. 
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
        - Food &harr; Restaurant: Many food belongs to one restaurant. This is a **many-to-one** relationship.
        - Food &harr; Food Category: A food is categoeized under many food category. This is a **one-to-many** relationship.
        - Food &harr; Like: A food can be liked by many users, and each like belongs to a single food. This is a **one-to-many** relationship.
        - Food &harr; Review: A food can be reviewed multiple times by different users, and each review belongs to a single food. This is a **one-to-many** relationship.
        - Food &harr; Bookmark: A food can be bookmarked.
6. ### FoodCategory_Food
   - - **Properties:**
        -  This entity handles the many-to-many relationship between foodcategory and food.
    - **Mandatory & Optional:**
        - **Mandatory:** foodcategory_food, food_id, and category_id.
    - **Relationship:**
        - FoodCategory &harr; FoodCategory_Food: Each category can have many food linked through the FoodCategory_Food entity.
7. ### Review
    - **Properties:**
        -  Like has it review_id,  rating, comment, food_id, created_at and user_id.
        -  A review has a content (250 characters) and a timestamp for when it was created.
        -  Rating has 5 stars.
    - **Mandatory & Optional:**
        - **Mandatory:** review_id,  rating, food_id, created_at and user_id.
        - **Optional:** comment
    - **Relationship:**
        - Like &harr; Food: Many likes and reviews belongs to one food.
        - Like &harr; User: Many likes and reviews are done by one user.
8. ### Bookmark
    - **Properties:**
        - Bookmark is a place where user can easily access/save their favorite foods.
    - **Mandatory & Optional:**
        - **Mandatory:** bookmark_id, user_id, food_id
        - **Optional:** None
    - **Relationship:**
        - Bookmark &harr; Food: A bookmark can have multiple food posts.
9. ### Payment
    - **Properties:**
        - Payment process is initiated when users want to post their own foods.
        - Payment contains payment_id, user_id, amount, payment_method, status, and created_at.
        - Payment can be done using esewa or khalti. 
    - **Uniqueness:**
        - payment_id 
    - **Mandatory & Optional:**
        - all the attributes are mandatory. 
    - **Relationship:**
        - User &harr; Payment: User makes payment for premium feature.
10. ### Question  
    - **Properties:**
        -  Question contain question_id, user_id, content, food_id and created_at.
        -  Q&A section is there for every food post.
    - **Mandatory & Optional:**
        - **Mandatory:** question_id, user_id, food_id, content, and created_at.
        - **Optional:** None
    - **Relationship:**
        - Question &harr; Answer: Questions can have multiple answers.
        - Question &harr; User: Many questions are asked by a user. 
11. ### Answer
    - **Properties:**
        - An answer contain answer_id, user_id, question_id, content, and created_at.
    - **Uniqueness:**
    - **Mandatory & Optional:**
        - **Mandatory:** answer_id, user_id, question_id, content, and created_at.
        - **Optional:** None
    - **Relationship:**
        - Answer &harr; User: Multiple answers are gave by a user.
        - Ansers &harr; Question: Many answers has one question. 

## Entity Relationship Diagram (ERD)
![ERD](./FoodiesArchive_erd.png)
