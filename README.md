# The Blog App Demo

This is just a demo app

# Installation steps

1. create a virtual host for apache or nginx for the domain: the-blog.local
2. edit the .env file for db credentials
2. run composer install
3. create db schema the_blog
4. run php artisan migrate
5. run php artisan db:seed
6. run php artisan import:blog-posts
7. run npm install or yarn - yarn is faster
8. run npm run dev or npm run production
9. that should be it :)
