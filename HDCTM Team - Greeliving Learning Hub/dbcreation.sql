-- Drop tables if they exist

DROP TABLE IF EXISTS RecruiterInterview;
DROP TABLE IF EXISTS JobSeekerInterview;
DROP TABLE IF EXISTS ExtracurriculumActivity;
DROP TABLE IF EXISTS WorkingExperience;
DROP TABLE IF EXISTS Education;
DROP TABLE IF EXISTS Skill;
DROP TABLE IF EXISTS CourseRegistration;
DROP TABLE IF EXISTS Course;
DROP TABLE IF EXISTS Application;
DROP TABLE IF EXISTS Job;
DROP TABLE IF EXISTS Recruiter;
DROP TABLE IF EXISTS JobSeeker;
DROP TABLE IF EXISTS UserAuthentication;

-- Create tables

-- Create UserAuthentication table
CREATE TABLE UserAuthentication (
    UserAuthenticationID INT PRIMARY KEY AUTO_INCREMENT,
    UserEmail VARCHAR(255) NOT NULL,
    UserPassword VARCHAR(255) NOT NULL,
    UserRole VARCHAR(50) NOT NULL
);

-- Create JobSeeker table
CREATE TABLE JobSeeker (
	JobSeekerID int(11) PRIMARY KEY AUTO_INCREMENT,
	UserAuthenticationID int(11) NOT NULL,
	FirstName varchar(50) NOT NULL,
	LastName varchar(50) NOT NULL,
	Address varchar(255) NOT NULL,
	Phone varchar(20) NOT NULL,
	Gender varchar(100) NOT NULL,
	DOB date NOT NULL,
	JSJobTitle varchar(100) NOT NULL,
	ExperienceLevel varchar(50) NOT NULL,
	JSImage varchar(255) NOT NULL,
    FOREIGN KEY (UserAuthenticationID) REFERENCES UserAuthentication(UserAuthenticationID)
);

-- Create Course table
CREATE TABLE Course (
    CourseID INT PRIMARY KEY AUTO_INCREMENT,
    CourseCategory VARCHAR(255) NOT NULL CHECK (
        CourseCategory IN ('F&B', 'Beauty & Spa', 'Tourism & Hospitality')
    ),
    Title VARCHAR(100) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL CHECK (Price >= 0),
    Length INT NOT NULL,
    CourseImage VARCHAR(255) NOT NULL
);

-- Create CourseRegistration table
CREATE TABLE CourseRegistration (
    CourseRegistrationID INT PRIMARY KEY AUTO_INCREMENT,
    JobSeekerID INT NOT NULL,
    CourseID INT NOT NULL,
    FOREIGN KEY (CourseID) REFERENCES Course(CourseID),
    FOREIGN KEY (JobSeekerID) REFERENCES JobSeeker(JobSeekerID)
);

-- Create Skill table
CREATE TABLE Skill (
    SkillID INT PRIMARY KEY AUTO_INCREMENT,
    JobSeekerID INT NOT NULL,
    SkillName VARCHAR(255) NOT NULL,
    FOREIGN KEY (JobSeekerID) REFERENCES JobSeeker(JobSeekerID)
);

-- Create Education table
CREATE TABLE Education (
    EducationID INT PRIMARY KEY AUTO_INCREMENT,
    JobSeekerID INT NOT NULL,
    Degree VARCHAR(100) NOT NULL,
    Institution VARCHAR(255) NOT NULL,
    GraduationYear INT NOT NULL CHECK (GraduationYear >= 1900),
    GPA DECIMAL(3, 2) NOT NULL CHECK (GPA >= 0 AND GPA <= 4),
    FOREIGN KEY (JobSeekerID) REFERENCES JobSeeker(JobSeekerID)
);

-- Create WorkingExperience table
CREATE TABLE WorkingExperience (
    WExperienceID INT PRIMARY KEY AUTO_INCREMENT,
    JobSeekerID INT NOT NULL,
    WJobRole VARCHAR(100) NOT NULL,
    WCompanyName VARCHAR(255) NOT NULL,
    WTimeRange VARCHAR(50) NOT NULL,
    WDescription TEXT NOT NULL,
    FOREIGN KEY (JobSeekerID) REFERENCES JobSeeker(JobSeekerID)
);

-- Create ExtracurriculumActivity table
CREATE TABLE ExtracurriculumActivity (
    ActivityID INT PRIMARY KEY AUTO_INCREMENT,
    JobSeekerID INT NOT NULL,
    OrganizationName VARCHAR(255) NOT NULL,
    EAJobRole VARCHAR(100) NOT NULL,
    EATimeRange VARCHAR(50) NOT NULL,
    EADescription TEXT NOT NULL,
    FOREIGN KEY (JobSeekerID) REFERENCES JobSeeker(JobSeekerID)
);

-- Create Recruiter table
CREATE TABLE Recruiter (
    RecruiterID INT PRIMARY KEY AUTO_INCREMENT,
    UserAuthenticationID INT NOT NULL,
    CompanyName VARCHAR(255) NOT NULL,
    Size INT NOT NULL,
    Introduction TEXT NOT NULL,
    CompanyPhone VARCHAR(20) NOT NULL,
    CompanyEmail VARCHAR(255) NOT NULL,
    CompanyImage VARCHAR(255) NOT NULL,
    FOREIGN KEY (UserAuthenticationID) REFERENCES UserAuthentication(UserAuthenticationID)
);

-- Create Job table
CREATE TABLE Job (
    JobID INT PRIMARY KEY AUTO_INCREMENT,
    RecruiterID INT NOT NULL,
    JobTitle VARCHAR(100) NOT NULL,
    Salary DECIMAL(10, 2) NOT NULL CHECK (Salary >= 0),
    JobDescription TEXT NOT NULL,
    WorkLocation VARCHAR(255) NOT NULL,
    ExperienceLevel VARCHAR(255) NOT NULL CHECK (
        ExperienceLevel IN ('Internship', 'Entry', 'Junior', 'Senior')
    ),
    WorkingFormat VARCHAR(255) NOT NULL CHECK (
        WorkingFormat IN ('Remote', 'Hybrid', 'Online', 'Offline')
    ),
    JobSpecialization VARCHAR(255) NOT NULL CHECK (
        JobSpecialization IN ('Beauty & Spa', 'F&B', 'Tourism & Hospitality', 'Event')
    ),
    JobImage VARCHAR(255) NOT NULL,
    FOREIGN KEY (RecruiterID) REFERENCES Recruiter(RecruiterID)
);

-- Create JobSeekerInterview table
CREATE TABLE JobSeekerInterview (
    JSInterviewID INT PRIMARY KEY AUTO_INCREMENT,
    JobSeekerID INT NOT NULL,
    JobID INT NOT NULL,
    InterviewDate DATE,
    InterviewTime TIME,
    FOREIGN KEY (JobSeekerID) REFERENCES JobSeeker(JobSeekerID),
    FOREIGN KEY (JobID) REFERENCES Job(JobID)
);

-- Create RecruiterInterview table
CREATE TABLE RecruiterInterview (
    RecruiterInterviewID INT PRIMARY KEY AUTO_INCREMENT,
    JobID INT NOT NULL,
    DateStart DATE,
    DateEnd DATE,
    TimeStart TIME,
    TimeEnd TIME,
    LinkMeeting VARCHAR(255),
    FOREIGN KEY (JobID) REFERENCES Job(JobID)
);

-- Create Application table
CREATE TABLE Application (
    ApplicationID INT PRIMARY KEY AUTO_INCREMENT,
    JobSeekerID INT NOT NULL,
    JobID INT NOT NULL,
    FOREIGN KEY (JobID) REFERENCES Job(JobID),
    FOREIGN KEY (JobSeekerID) REFERENCES JobSeeker(JobSeekerID)
);