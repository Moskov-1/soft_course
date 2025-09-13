# 🎓 Soft Course

A modular course management system built with **Laravel**.  
This project allows you to create courses with unlimited nested modules and polymorphic content.

---

## ✨ Features

- **Courses**  
  - Each course can have unlimited modules.  
  - Courses support **levels**, **categories**, and **dependencies**.  
  - Authentication & authorization enabled.  

- **Modules**  
  - Belong to a course.  
  - Unlimited per course.  
  - Nest and organize learning content.  

- **Content (Polymorphic)**  
  - Nested inside modules.  
  - Currently supports **Video** content type.  
  - Extensible design → scope for other media types (e.g. Quiz, Text, PDF, Audio).  

---

## 🖼️ Screenshots / UI

_Add screenshots here for better visualization._

- Course creation page:  
  ![Course Form](./docs/images/course-create.png)

- Module nesting:  
  ![Modules](./docs/images/modules.png)

- Video content example:  
  ![Video Content](./docs/images/video-content.png)

---

## ⚙️ Installation

_Replace this section with actual steps/commands once finalized._

```bash
# 1. Clone the repository
git clone https://github.com/Moskov-1/soft_course.git

# 2. Navigate to project
cd soft_course

# 3. Install dependencies
composer install
npm install && npm run build

# 4. Copy environment file and configure
cp .env.example .env
php artisan key:generate

# 5. Run migrations & seeders
php artisan migrate --seed

# 6. Start local server
php artisan serve
