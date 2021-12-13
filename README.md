# Blogging System / Content Management System 📘

Complete blog application from scratch using PHP and MySQL database.

## Features

- A user registration system that manages two types of users: **Admin** and **Normal** users.
- The CMS have an admin area and a public area separate from each other
- The admin area will be accessible only to logged in admin users and the public area to the normal users and the general public.
- In the admin section, two types of admins exist:

  - **Admin :**
    - Can create, view, update, publish/unpublish and delete ANY post.
    - Can also create, view, update and delete topics.
    - An Admin user (and only an Admin user) can create another admin user or Author
    - Can view, update and delete other admin users
  - **Author :**
    - Can create, view, update and delete only posts created by themselves
    - They cannot publish a post. All publishing of posts is done by the Admin user.

- Only published posts are displayed in the public area for viewing
- Each post is created under a particular topic
- A many-to-many relationship exists between posts and topics.
- The public page lists posts each post displayed with a featured image, author, and date of creation.
- The user can browse through all posts listings under a particular topic by clicking on the topic
- When a user clicks on a post, they can view the full post and comment at the bottom on the posts

### Prerequisites

Basic understanding of **PHP** language and **MySQL** database management system.

### Installing

1. Clone the repository

```bash
git clone
```

## Tools Used

- [XAMPP](https://www.apachefriends.org/) - PHP development environment.
- [phpMyAdmin](https://www.phpmyadmin.net/) - Administration tool for MySQL.
- [Visual Studio Code](https://www.phpmyadmin.net/) - Source-Code Editor.

## Built With

- [PHP](https://www.php.net/) - General-purpose scripting language.
- [MySQL](https://www.mysql.com/) - Open-source relational database management system.
- [Git](https://git-scm.com/) - Software for tracking changes.

## Authors

- **Sumesh Majhi** - _Portfolio Site_ - [MajhiRockzZ](https://majhirockzz.xyz/)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Acknowledgments

- [Edwin Diaz](https://edwindiaz.com/) - The Instructor that cares! 😇
