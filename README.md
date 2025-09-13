# Soft Course 🎓

A modular LMS-type project built with **Laravel**.  
Courses → Modules → Polymorphic Content. Auth, Levels, Categories built in.

---

## Features

- **Courses**  
  - Create unlimited courses.  
  - Each course can have many **modules**.  
  - Courses have **level** and **category** dependencies.  
  - Authentication & authorization included (only logged-in users can manage content).  

- **Modules**  
  - Nested under courses.  
  - Unlimited modules per course.  

- **Content (Polymorphic)**  
  - Nested under modules.  
  - Content can be of different types (currently **Video**), with ability to extend (e.g. Text, Quiz, Audio, etc.).  
  - Videos have fields like `title`, `source_type`, `url`, `length_in_seconds`.  

- **Demo User Seeded**  
  - There is a seeder that creates a demo user:  
    - **Email**: `admin@gmail.com`  
    - **Password**: `Soft123`

- **Extra Assets Folder**  
  - The `z_extra` folder holds an extra `manifest.json` and CSS to help resolve npm/build-related issues.  

---

## Database Schema Overview  

Below is an Entity-Relationship sketch showing how the major tables relate:

