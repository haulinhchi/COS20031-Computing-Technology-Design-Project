# Welcome!

![image](images/LongLogo.png)

<p align="center"><strong>Subject</strong>: COS20031</p>

<p align="center"><strong>Semester</strong>: Fall 2023</p>

<p align="center">
  <a href="#team-members">Team members</a>  •
  <a href="#about-us">About us</a>  •
  <a href="#project-description">Project description</a>  •
  <a href="#features">Features</a>  •
  <a href="#installation">Installation</a>  •
  <a href="#running-instructions">Running instructions</a>
</p>

## Team members

- Lo Tuan Hung
- Luong Chi Duc
- Nguyen Vu Duy Minh
- Hau Linh Chi
- Dao Khanh Nga Thi

## About us

<p align="justify">We are a dynamic team comprised of five Computer Science students hailing from Swinburne University, proudly representing Group 1.3 in the COS20031 class during the vibrant Semester 3 of 2023.</p>

<p align="justify">Our mission centers on mastering IT project management and crafting digital solutions, including websites and web apps. As we advance, we aim to attain significant achievements and accolades while continually expanding our knowledge and capabilities.</p>

## Project description

<p align="justify">We developed functions on the current website of <a href="https://greeliving.edu.vn/">Greeliving</a>. The current web platform faces critical challenges in UI/UX optimization, database efficiency, and security. These challenges impact job-seekers, who lack clarity on needed skills and struggle to find suitable job opportunities. The absence of a secure authentication system, role-based access control, and user profile management poses significant risks. Additionally, the platform lacks crucial features for personalized user experiences, job transparency, and privacy in recruitment. These shortcomings compromise project objectives, affecting both the user experience and security standards.</p>

## Features

1. **Role-Based Access Control (RBAC)**
   - Upon user login, the system verifies their role and directs them to the appropriate profile page view, distinguishing between job seekers and recruiters.

2. **Job/Course Suggestions**
   - When a job seeker navigates to the Course/Job Opportunity page, the initial section displays a curated list of suggested courses/jobs based on their job title.

3. **Job/Course Filtering**
   - *Courses:*
     - F&B
     - Beauty & Spa
     - Tourism & Hospitality
   - *Jobs:*
     - Experience Level required
     - Working Formats available
     - Specialization

4. **Interview Schedule Process**
   - Recruiters can update the interview schedule for posted jobs. Upon successful update, the schedule information is presented for jobs that job seekers have applied to. Job seekers can provide their available time, and booked jobs are displayed in the interview schedule section, facilitating the tracking of interview appointments.

5. **CRUD Operations (Create - Update - Delete)**
   - Job seekers have the ability to update their profiles, delete information, and create new records as needed. This ensures flexibility and control over their account information.

# Prototype: Greeliving Learning Hub

Base on Cisco Packet Tracer (host: feenix-mariadb.swin.edu.au)

## Installation

- Download the full code
- Download XAMPP: https://www.apachefriends.org/download.html
- Install XAMPP, choose default options for installation (remember the folder where you install it, will be important later!)
- Open the folder xampp (where you install XAMPP)
- Go to folder 'htdocs'
- Unzip the code inside that folder
- Download ***Cisco AnyConnect Secure Mobility Client***


## Running Instructions
- Open XAMPP Control Panel, start 'Apache' and 'MySQL'.
- Connect to VPN: **vpn.swin.edu.au/mfa** and sign in Swinburne's account.
- Use the query in [database creation SQL file](dbcreation.sql) to generate the database.
- Open your web browser and access via this link: "http://localhost/SUT/Greeliving-Learning-Hub/login.php".
- Use the following accounts for a quick test:

| UserAuthenticationID | UserEmail          | Password | UserRole   |
|-----------------------|--------------------|----------|------------|
| 1                     | Jane@gmail.com     | 123456   | Recruiter  |
| 500001                | James@gmail.com    | 123456   | JobSeeker  |

- If you want to connect to the database by any other platform, please change the information in [setting](settings.php) file. *(You should not change the database name!)*
- Our present iteration employs the [phpMyAdmin](https://feenix-mariadb-web.swin.edu.au/) platform, imposing constraints on the volume of records that can be uploaded. Consequently, data testing is currently limited to approximately 1000-2000 records per table. In addition, we have created simulated datasets containing 1 million records per table, and you can access both sets of data [here](https://drive.google.com/drive/folders/19dOzXQKob0b6v8B8YSMt3m5iF1WtpLzy?usp=sharing).

***![demo video](https://drive.google.com/file/d/1V5T-XoJHjSegsNgyG-XLpEOiFDt44FxW/view?usp=sharing)***

![image](https://user-images.githubusercontent.com/114485224/209611403-fdc415c7-a877-42d1-b050-72b0bcbf7491.png)
