# Library Website

### Features
* Using a database full of books, you can search for books for information
* A library patron can search for a book, and place a hold on it to pick up at the library
* A librarian can view the current holds on books, and check them out to patrons
* A user can view the most checked out book after the one they are currently looking at.


### Build instructions for Linux

To install an SQL server
```bash
pip install mysql-server
```
Then you need to load in the database from the SQL folder
```bash
mysql -u username
dabase_name 434.sql
```
Install the LAMP stack
```bash
sudo apt-get install lamp-server^
```
Make a /includes/inc.db.php file, with a return connection to your database.

place the website in the correct folder for LAMP server, then you can visit the website on the port you have LAMP server set up on.
