<p align="center"><img src="image/header.png" alt="Header" width="100%" /></p>

# HopeNest | Reddit Clone App

Our primary objective is to develop a platform that works similar to Reddit and Twitter but is specially dedicated to families with special needs children and individuals with special needs to share their unique talents. This project also will allow our target users to share their thoughts and experiences openly to strengthen community bonds. This platform aims to provide moral support to our users, especially those who are newly aware of their child's needs. We plan to create this project by utilising Laravel, Vue.js, MySQL, and IBM Watson. As our project also targets individuals with special needs, we want to build a system that has a friendly interface view by displaying text with larger spacing and larger size than the existing system with colourful icons for users' convenience especially individuals with Dyslexia, Attention Deficit Hyperactivity Disorder (ADHD) and Cognitive Disabilities. Additionally, we want to provide Artificial intelligence assistance for user support. This specialised interface is designed to help users engage more effectively and act as a starting point for children with special needs to be exposed to other technologies.

[Access Documents](https://github.com/oishylea/RedditClone/tree/main/document)

## Features

- User authentication
- Post-creation and management
- Commenting system
- Upvoting and downvoting posts
- Responsive design

## Technologies Used

- **Backend**: Laravel
- **Frontend**: Inertia.js, Vue.js
- **Database**: MySQL

## Steps To Run The Code

1. **Clone the repository**
   ```bash
   cd reddit-clone
2. Install dependencies Install PHP dependencies:
   ```bash
   composer install
3. Install JavaScript dependencies:
   ```bash
   npm install
4. Generate application key
   ```bash
   php artisan key:generate
5. Run migrations Make sure your MySQL server is running and execute:
   ```bash
   php artisan migrate
6. Run the application Start the Laravel development server:
   ```bash
   php artisan serve

7. Run
   ```bash
   npm run dev
   
## Run The Code Using XAMPP
   
   run Apache -> Admin -> Localhost -> Folder -> Public<br><br><br>
   
-----------------------------------------------------
# Notes

## Step To Create Model

1. **Open the command prompt and start with cd FileLocation**
   ```bash
   php artisan make:model ModelName -m
