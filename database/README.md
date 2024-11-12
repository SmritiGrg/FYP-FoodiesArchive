# The Database Design 
- [Business  Rules](#business-rules)
- [Entity Relationship Diagram](#entity-relationship-diagram-erd)

## Business Rules

1. ### Users
    - **Properties:**
        - Users has first_name, last_name, username, email, password, image, role, and default_address.
        - User is categorized in three roles - admin, visitor, and content creator. 
        - Admin manages the posts, users, questions, answers and subscription.
        - Admin and content creator can create and post food posts.
        - Visitor and content creator can like, review, share and bookmark food posts.
        - Visitor and content creator can also ask questions and write answers on the food post.
        - Content creator has the ability to join a foodie community where they can create and post foods.
        - Content creator can create food post only after subscribing to the subscription.
        - Content creator can make payment through khalti as the payment gateway.
        - A user gets notification of all the newly uploaded posts, and replies to their questions.
        - Visitor and Content creator can write only one review to a single food post.
        - Same visitor and content creator cannot review the same food post.
    - **Uniqueness:**
        - username and email.
    - **Mandatory & Optional:**
        - **Mandatory:** first_name, last_name, username, email, password, and default_address.
        - **Optional:** image
    - **Relationship:**
        - Users &harr; Reviews: Each user can write multilpe reviews overall, but only one review per food post. This is a **one-to-many** relationship. 
        - Users &harr; Food_posts: A User can create multiple food post and a food post belongs to a specific user. This is a **one-to-many** relationship.
        - Users &harr; Food_posts: A User can  bookmark many food posts, and a food post is bookmarked by many users. This a **many-to-many** relationship.
        - Users &harr; Subscription_plan: A User can  subscribe to one subscription plan, and a subscription plan belongs to a specific user. This a **one-to-one** relationship.
        - Users &harr; Questions: A User can  ask many questions, and a question belongs to a specific user. This a **one-to-many** relationship.
       - Users &harr; Answers: A User can  write many answers, but each answer is written by a single user. This a **one-to-many** relationship.
2. ### Restaurants
    - **Properties:**
        -  A restaurant has name, phone_number, email, website_link, province, city, address, image, open_time, and close_time.
        -  A restaurant contains many foods.
    - **Uniqueness:**
        - phone_number
    - **Mandatory & Optional:**
        - **Mandatory:** name, phone_number, province, city, address
        - **Optional:** email, website_link, province, city, address, image, open_time, and close_time.
    - **Relationship:**
        - Restaurants &harr; Food_posts: A restaurant contains many food posts and each food post uniquely belongs to a single restaurant. This a **one-to-many** relationship.
4. ### Category
    - **Properties:**
        - Food category has name.
        - Each food are assigned to one or many categtories to make it easy for users to browse.
    - **Uniqueness:**
        - Each category name should be unique. 
    - **Mandatory & Optional:**
        - **Mandatory:** name
    - **Relationship:**
        - Food Category &harr; Food:  Food category contains many foods, and a food can belong to many categories.This is a **many-to-many** relationship. 
5. ### Food_posts
    - **Properties:**
        - A food post has name, description, price, restaurant_id, and image.
        - A food post is categorized under many food categories.
        - A food post contain its name, description, price, image, and a timestamp for when it was created.
    - **Uniqueness:**
        - food_post_id 
    - **Mandatory & Optional:**
        - **Mandatory:** name, price, restaurant_id, and image.
        - **Optional:**  description
    - **Relationship:**
        - Food_post &harr; Reviews: A food post can have many reviews, but each review is unique to a specific user. This is a **one-to-many** relationship.
6. ### FoodCategory_Food
   - - **Properties:**
        -  This entity handles the many-to-many relationship between foodcategory and food.
    - **Mandatory & Optional:**
        - **Mandatory:** foodcategory_food, food_id, and category_id.
    - **Relationship:**
        - FoodCategory &harr; FoodCategory_Food: Each category can have many food linked through the FoodCategory_Food entity.
7. ### Reviews
    - **Properties:**
        -  Review has review_id, like(boolean), stars, content, food_id, and user_id.
        -  A review has a content (250 characters) and a timestamp for when it was created.
        -  Rating has 5 stars.
    - **Mandatory & Optional:**
        - **Mandatory:** review_id,  like(boolean), stars, content, food_id, and user_id.
    - **Relationship:**
        - Reviews &harr; Food_post: Many reviews belongs to one food post.
8. ### Subscription_Plan
    - **Properties:**
        - Subscription_Plan is shown when users want to join the foodie community where they can create and post foods.
        - Subscription_Plan has subscription_plan_id, plan_name, amount, description, start-date, status, and user_id.
        - There is only one subscription plan which is life time access.
        - To subscribe to subscription plan payement most be done.
    - **Uniqueness:**
        - user_id 
    - **Mandatory & Optional:**
        - **Mandatory:** subscription_plan_id, plan_name, amount, description, start-date, status, and user_id. 
    - **Relationship:**
        - Subscription_Plan &harr; Payment: Each subscription has one payment. This is **one-to-one** relationship.
9. ### Payment
    - **Properties:**
        - Payment has payment_id, amount_paid, khalti_transaction_id, status, and payment_date.
        - Payment can be done using khalti as the payment gateway. 
    - **Uniqueness:**
        - payment_id, khalti_transaction_id
    - **Mandatory & Optional:**
        - all the attributes are mandatory. 
10. ### Questions
    - **Properties:**
        -  Question contain question_id, user_id, content, and food_id.
        -  Q&A section is there for every food post.
    - **Mandatory & Optional:**
        - **Mandatory:** question_id, user_id, food_id, content.
        - **Optional:** None
    - **Relationship:**
        - Question &harr; Answer: Each question has multiple answers, and each answer belongs to a specific question. This is **one-to-many** relationship.
11. ### Answers
    - **Properties:**
        - An answer contain answer_id, user_id, question_id, and content.
    - **Mandatory & Optional:**
        - **Mandatory:** answer_id, user_id, question_id, and content.
12. ### Bookmark
    - **Properties:**
        - Bookmark is a place where user can easily access/save their favorite foods.
    - **Mandatory & Optional:**
        - **Mandatory:** bookmark_id, user_id, food_id
        - **Optional:** None
    - **Relationship:**
        - Bookmark &harr; Food_posts: A bookmark can have multiple food posts.

## Entity Relationship Diagram (ERD)
![ERD](./FoodiesArchive_erd.png)
