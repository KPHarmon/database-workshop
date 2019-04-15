# ACM Database Workshop
* This workshop will teach you the basics of creating and accessing a PostgresSQL database.
* Then, we will be using PHP and PostgreSQL to create a simple login application.

## Setup

### Installing Postgres and PHP for Mac
* Postgres Installation
	* [Install Homebrew](https://brew.sh) (If you have not already)
	* Run the command `brew install postgresql`
	* Run `pg_ctl -D /usr/local/var/postgres start` to start the service
	* Run the command `postgres -V` to check the version number
 
* PHP Installation
	* Run `brew install php`
	* Run the command `php -v` to check the version number 
	* We need to edit our config file `sudo vim /etc/php.ini` and delete the semicolon on the following line:
		* `;extension=pgsql`
		* Note: file location may be different then above

### Installing Postgres and PHP for Windows
* Postgres Installation
	* [Download the installer here](https://www.postgresql.org/download/windows/)
	* Set the path to pqsl in environment variables
	* Run the command `psql --version` to check the version number
 
* PHP Installation
	* [Download the Zip file here](https://www.php.net/downloads.php)
	* Extract in a location
	* Set the path to /bin in environment variables
	* Run the command `php -v` to check the version number 
	* Rename your php.ini-production file to php.ini
	* Then we need to edit our config file by finding the php.ini file and editing it as an admin to delete the semicolon on the following line:
		* `;extension=pgsql`

### Installing Postgres and PHP for Linux
* Postgres Installation
	* Run the command `sudo apt-get install postgresql`
	* Run the command `psql --version` to check the version number
		* I am running 10.7 on Ubuntu
 
* PHP Installation
	* Run the command `sudo apt-get install php7.2-cli`
	* Run the command `php -v` to check the version number 
		* I am running 7.2.15 on Ubuntu
	* We also need to make sure we installed the php driver to connect to our database by running `sudo apt-get install php7.2-pgsql`
	* Then we need to edit our config file `sudo vim /etc/php/7.2/cli/php.ini` and delete the semicolon on the following line:
		* `;extension=pgsql`
 
### Workshop Source Code
* [Install Git if you have not already](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
* `cd` to directory you wish to install the source code in
* Clone this repo: [database-workshop](https://github.com/SCUACM/node-workshop)
* `cd` into the newly created `database-workshop` directory.
* If you `ls`, you should be able to see `index.php`, `login.php`, and `register.php`

## SQL Configuration
* First, we need to give ourselves access to postgres.
* Connect to postgres by running 'sudo -u postgres psql'
	* (Windows users can use `psql -U postgres` and then supply the password they designated during installation)
* Run `ALTER USER postgres with encrypted password '*******';` where the '*******' are a password of your choice.
* Disconnect to postgres by typing `\q` or pressing `ctrl+d`
* Edit the following file using: `sudo vim /etc/postgresql/10/pg_hba.conf`
	* (Note: `pg_hba.conf` May be in a different location)
	* (Note 2: You may use any text editor you would like)
	* Find the line concerning the __postgres__ user
	* Change `peer` to `md5`
* Restart postgres using `sudo /etc/init.d/postgresql restart`
* Check which user you are by running `whoami`
* Run `createuser -U postgres -d -e -E -l -P -r -s <user>`
* Edit pg_hba.conf again changing the line concerning local
	* Change `peer` to `md5`
* Restart postgres using `sudo /etc/init.d/postgresql restart`
* Run 'psql template1' to see if the change was successful
* You should now be able to access psql as your home user

## SQL Tutorial
* Let's create our first database!
* If you are not already logged in, run `psql template1`
* We are going to create a test database for a bookstore.
* To create a database, we use the command `CREATE DATABASE bookstore;`
* Great! Now we have a database.  Connect to it using the command `\c bookstore;`
* Now we need to create tables to store our data.
* To create a table, we need to define properties that our table elements will have.  The following creates a table called 'books' where each element has an id number, a title, author, and date published field:
 
	```
	   CREATE TABLE books(
	   id serial PRIMARY KEY,
	   title varchar(50) UNIQUE NOT NULL,
	   author varchar(50) NOT NULL,
	   date_published int NOT NULL
	   ); 
	```

	* (Unique means that new elements cannot be created if it shares a characteristic with an element already in the table)
	* (NOT NULL means that this property must be specified when adding an element to the table)

* Now it's time to populate our table!  To do that, we need to use `INSERT INTO`
* The table and values we are inserting all need to be specified.  Using our bookstore example, we can use:

	```
	INSERT INTO books(title, author, date_published) VALUES
	   ('The Great Gatsby', 'F. Scott Fitzgerald', 1925),
	   ('Moby Dick', 'Herman Melville', 1851),
	   ('The Catcher in the Rye', 'J.D. Salinger', 1945),
	   ('Harry Potter and the Chamber of Secrets', 'J.K. Rowling', 1998),
	   ('Harry Potter and the Goblet of Fire', 'J.K. Rowling', 1998),
	   ('Catch-22', 'Joseph Heller', 1961);
	```
* Sweet!  Now we have 6 books in our collection.  Let's take a look at them by using `SELECT * FROM books;`
	* The asterisk means that we are going to return all of the properties of each element we find and `books` refers to the table we are going to search.
	* You should see a nice table of all 6 books.
* What if you only wanted to see books written by J.K. Rowling?  We can modify our above statement to do just that.  Run `SELECT title FROM books WHERE author='J.K. Rowling';`
	* You should now see the two books written by J.K. Rowling.  Perfect!
* For our last trick, let's search for all the information we have for books that were written before 1950.  See if you can figure it out first, then check your answer.
	* ~~SELECT * from books WHERE date_published<1950;~~
* Now that we have the basics of SQL down, it's time to put all of this knowledge to work.

## Login Application
* The goal of this section is to create a simple login application using PHP and and SQL database.
	* Disclaimer: We are going to be using the Facebook method for storing passwords which means we will just be leaving them in plaintext in our database. This is not secure and should not be done for any application in production!!!
* First, let's make a database.  Using the steps above, create and then connect to a postgres database
	* (i.e. `CREATE DATABASE <dbname>`)
* Then, create a table to host our application's users.
	* In our example, we assume that there is an incrementing 'id', 'username', and 'password' field.
* That is all we need to do with our database.  Now let's move onto the actual login application.
* `cd` into the directory in which you downloaded 'index.php', 'login.php', and 'register.php';
* Use the following command to start a web server hosted on localhost port 8000 `php -S localhost:8000`
* To view the webpages, use an internet browser of your choice and type `localhost:8000` into the searchbar.
* Great start, but you will have to fill in some values in both the register.php file and the login.php value.  They are denoted with < >.
* After you fill in the necessary variables, give it a try!  Register an account and then log in.  If you are curious about what your database looks like as you add more users, simply use the `SELECT * FROM <tablename>;` command when connected to your database.
* Tada! You have a functioning application.

## Future Additions
* SQL Injection
	* The following code is vulnerable to an interesting vulnerability known as SQL Injection.  This is an easy method hackers use to gain access to databases and bypass verification.  Read up on SQL Injections a bit and see if you can exploit your new login system!  [Here is a good place to start](https://www.w3schools.com/sql/sql_injection.asp).  After you break in, see if you can fix it.
* Make is Pretty!
	* As it stands, this application is boring. See if you can spice things up with some pictures, animations, and some css.
* More Features
	* Create an admin account that is capable of deleting accounts.
	* Allow users to update their information.
	* Create an interesting application that can utilize this login system and database! 
