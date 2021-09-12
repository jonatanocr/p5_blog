## General info
This project is a simple blog written in PHP.
	
## Setup
To run this project, install it locally using git:

```
git clone https://github.com/jonatanocr/p5_blog.git
composer install
```
rename `Core/config/config_exemple.php` file as `config.php` and edit it (by default the smtp server is Gmail)

You can run the script in the `init_db.sql` file to start with an empty database or import `blog_jonatan.sql` file if you want to start with already created mock posts and users data.

## Usage

Mock users created:

username | password
--- | ---
admin | password
visitor | password

(user must have user_type = 'admin' in db to create or edit blog post)
