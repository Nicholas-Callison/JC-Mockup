DROP DATABASE IF EXISTS JC_PATHWAYS;
CREATE DATABASE JC_PATHWAYS DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE JC_PATHWAYS;

-- User information
--
CREATE TABLE Users (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(20) NOT NULL,
  email VARCHAR(255) NOT NULL,
  passwd CHAR(64) NOT NULL,
  salt CHAR(32) NOT NULL DEFAULT '',
  real_name VARCHAR(64) NOT NULL DEFAULT '',
  suspended TINYINT UNSIGNED NOT NULL DEFAULT 1,
  last_login_ts BIGINT UNSIGNED NOT NULL DEFAULT 0,
  last_ip VARCHAR(45) NULL DEFAULT NULL,
  type TINYINT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (id),
  UNIQUE (username),
  UNIQUE (id),
  INDEX (type)
) ENGINE = InnoDB;

-- Session information
--
CREATE TABLE Sessions (
  uid INTEGER UNSIGNED NOT NULL,
  sid CHAR(32) NOT NULL,
  ts BIGINT UNSIGNED NOT NULL,
  FOREIGN KEY (uid) REFERENCES Users(id) ON DELETE CASCADE,
  UNIQUE (sid)
) ENGINE = InnoDB;

-- Department information
--
CREATE TABLE Departments (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  dept_chair_id INTEGER UNSIGNED NULL,
  PRIMARY KEY (id),
  INDEX (dept_chair_id),
  FOREIGN KEY (dept_chair_id) REFERENCES Users(id) ON DELETE NO ACTION
) ENGINE = InnoDB;

-- Degree Program information
--
CREATE TABLE Programs (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  type TINYINT UNSIGNED NOT NULL DEFAULT 1,
  lead_faculty_id INTEGER UNSIGNED NULL,
  department_id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  INDEX (lead_faculty_id),
  INDEX (department_id),
  FOREIGN KEY (lead_faculty_id) REFERENCES Users(id) ON DELETE NO ACTION,
  FOREIGN KEY (department_id) REFERENCES Departments(id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- Semester information
--
CREATE TABLE Semesters (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  year TINYINT UNSIGNED NOT NULL DEFAULT 1,
  term CHAR(2) NOT NULL DEFAULT 'FL',
  PRIMARY KEY (id)
) ENGINE = InnoDB;

-- Map information
--
CREATE TABLE Maps (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  program_id INTEGER UNSIGNED NOT NULL,
  semester_id INTEGER UNSIGNED NOT NULL,
  note TEXT NULL DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX (program_id),
  INDEX (semester_id),
  FOREIGN KEY (program_id) REFERENCES Programs(id) ON DELETE CASCADE,
  FOREIGN KEY (semester_id) REFERENCES Semesters(id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- Subject Information
--
CREATE TABLE Subjects (
  code CHAR(3) NOT NULL,
  name VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (code)
) ENGINE = InnoDB;

-- Course Information
--
CREATE TABLE Courses (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  subject_code CHAR(3) NOT NULL,
  -- Be sure to format this number correctly on the site (###)
  course_number SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  title VARCHAR(255) NOT NULL DEFAULT '',
  credits TINYINT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (id),
  INDEX (subject_code),
  FOREIGN KEY (subject_code) REFERENCES Subjects(code) ON DELETE CASCADE
) ENGINE = InnoDB;

-- Prerequisite Course Information
--
CREATE TABLE Prerequisites (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  course_id INTEGER UNSIGNED NOT NULL,
  prerequisite_id INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY (id),
  INDEX (course_id),
  FOREIGN KEY (course_id) REFERENCES Courses(id) ON DELETE CASCADE,
  FOREIGN KEY (prerequisite_id) REFERENCES Courses(id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- Course Map information
--
CREATE TABLE MapCourse (
  id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  map_id INTEGER UNSIGNED NOT NULL,
  course_id INTEGER UNSIGNED NOT NULL,
  milestone_activity TEXT NULL DEFAULT NULL,
  course_type TINYINT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (id),
  INDEX (map_id),
  FOREIGN KEY (map_id) REFERENCES Maps(id) ON DELETE CASCADE,
  FOREIGN KEY (course_id) REFERENCES Courses(id) ON DELETE CASCADE
) ENGINE = InnoDB;
