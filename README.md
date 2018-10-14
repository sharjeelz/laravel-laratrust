Laratrust (5.6) CMS

# Steps to Install 

0. add Database and add credentials to your .env file
1. git clone  https://github.com/sharjeelz/laravel-laratrust.git
2. run "composer update"
3. run "php artisan make:auth"   --> # This will add auth scafolding in your project
4. run "php artisan migrate"
6. run "php artisan db:seed"    ---> # This will add a default user (having owner role and root permission
5. run "php artisan serve"  --> #access the server by localhost:8000
6. make sure your xampp/lamp/wamp is running before you login to the system

## If you want Emails to Work Setup mailtrap (https://mailtrap.io)  Its free for testing emails and add your credentionals in .env file.
## Courtsy 



# Let me know if you have any issues
# I am still developing Events Section where notification will fly around on any action performed on this CMS using VUE, Pusher.

