# Time management project for Srisomwong Company

## Background
I am in Information Officer position of Srisomwong Company. I need to create time management for company to manage working time and keep statistic of every employee.

## Requirement.
- PHP version 7.4 or more.
- PHP development environment such as XAMPP.

## How to Deploy on Localhost (base tutorial on XAMPP)

### Step 1 : set up XAMPP
1. turn on server
    - MySQL Database
    - Apache Web Server

### Step 2 : Set up project folder
1. Download project file as zip file
2. Unzip file to folder
3. Rename folder to `sws-time-management`
3. Copy folder to `xampp/htdocs/`

### Step 3 : set up database
1. Open any browser
2. Go to `localhost/phpmyadmin`
3. On the left pane, click *New*
4. Set *Database name* to `srisomw_time`
5. Set *Collation* to `utf8_general_ci`
6. On the middle top of screen, click *Import* menu
7. At *File to import* section, click *Choose File*
8. Go to `xampp/htdocs/sws-time-management/SQL`
9. Select file `srisomw_time.sql`
10. Set *Character set of the file* to `utf-8`
11. Go to bottom of page, then click *Import* button

### Step 4 : Set up database config in project file
1. Open project folder.
2. Go to `application/config/database.php`
3. edit *$username* variable to your PHPMyAdmin username (default is 'root')
4. edit *$password* variable to your PHPMyAdmin password (default is empty)
5. save file

### Step 5 : Open web app
1. Open new tab browser
2. Go to `localhost/sws-time-management`
3. Done

## How to use
1. Login with username "cheetah5900" and password "123"
2. first page name "ลงเวลางาน" at top left of screen
    2.1 this page is for signing in to work on morning, afternoon and evening
    2.2 before sign out at evening time, there is box for telling problem about work of today. This problem will report to head of that department.
    2.3 At bottom of page is login history of each logined person
3. second page name "ปัญหาที่พบ" at top left of screen
    3.1 first sub menu : Show problem that employee reported at 2.2 topic. but doesn't reach defined time.
    3.2 second sub menu : Show all solved problem that employee reported at 2.2 topic.
4. third page name "ตรวจงาน" at top left of screen
    4.1 For head of department to conclude work progress each day to CEO.
    4.2 They can see what other department conclude.
5. Fourth page name "สรุปงาน" at top left of screen
    5.1 For CEO to see what head of department conclude to them.
6. Fifth page name "พนักงาน" at top left of screen
    6.1 this page can add and manage employee data
7. Sixth page name "HR" at top left of screen
    7.1 For Human Resources department to export report to calculate salary and check in time.


