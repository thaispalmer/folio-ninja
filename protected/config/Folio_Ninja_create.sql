-- Created by Vertabelo (http://vertabelo.com)
-- Script type: create
-- Scope: [tables, references, sequences, views, procedures]
-- Generated at Tue Feb 10 16:19:00 UTC 2015




-- tables
-- Table folder
CREATE TABLE folder (
    id int    NOT NULL  AUTO_INCREMENT,
    title varchar(50)    NOT NULL ,
    user_id int    NOT NULL ,
    team_id int    NULL ,
    CONSTRAINT folder_pk PRIMARY KEY (id)
);

-- Table links_per_project
CREATE TABLE links_per_project (
    id int    NOT NULL  AUTO_INCREMENT,
    project_id int    NOT NULL ,
    url text    NOT NULL ,
    title varchar(50)    NOT NULL ,
    description text    NULL ,
    CONSTRAINT links_per_project_pk PRIMARY KEY (id)
);

-- Table picture
CREATE TABLE picture (
    id int    NOT NULL  AUTO_INCREMENT,
    filename text    NOT NULL ,
    CONSTRAINT picture_pk PRIMARY KEY (id)
);

-- Table pictures_per_project
CREATE TABLE pictures_per_project (
    id int    NOT NULL  AUTO_INCREMENT,
    picture_id int    NOT NULL ,
    project_id int    NOT NULL ,
    title varchar(50)    NULL ,
    description text    NULL ,
    CONSTRAINT pictures_per_project_pk PRIMARY KEY (id)
);

-- Table plan
CREATE TABLE plan (
    id int    NOT NULL  AUTO_INCREMENT,
    title varchar(50)    NOT NULL ,
    sku varchar(10)    NOT NULL ,
    price decimal(10,2)    NOT NULL ,
    duration_in_days int    NOT NULL ,
    projects int    NOT NULL DEFAULT 0 ,
    pictures_per_project int    NOT NULL DEFAULT 0 ,
    videos_per_project int    NOT NULL DEFAULT 0 ,
    links_per_project int    NOT NULL DEFAULT 0 ,
    teams int    NOT NULL DEFAULT 0 ,
    users_per_team int    NOT NULL DEFAULT 0 ,
    CONSTRAINT plan_pk PRIMARY KEY (id)
);

-- Table project
CREATE TABLE project (
    id int    NOT NULL  AUTO_INCREMENT,
    name varchar(255)    NOT NULL ,
    description text    NULL ,
    picture_id int    NULL ,
    user_id int    NOT NULL ,
    team_id int    NULL ,
    folder_id int    NULL ,
    CONSTRAINT project_pk PRIMARY KEY (id)
);

-- Table subscription
CREATE TABLE subscription (
    id int    NOT NULL  AUTO_INCREMENT,
    user_id int    NOT NULL ,
    plan_id int    NOT NULL ,
    hire timestamp    NOT NULL ,
    expires timestamp    NOT NULL ,
    CONSTRAINT subscription_pk PRIMARY KEY (id)
);

-- Table team
CREATE TABLE team (
    id int    NOT NULL  AUTO_INCREMENT,
    alias varchar(32)    NOT NULL ,
    name varchar(50)    NOT NULL ,
    picture_id int    NULL ,
    CONSTRAINT team_pk PRIMARY KEY (id)
);

-- Table user
CREATE TABLE user (
    id int    NOT NULL  AUTO_INCREMENT,
    level enum('Admin','User')    NOT NULL DEFAULT 'User' ,
    email varchar(255)    NOT NULL ,
    alias varchar(32)    NOT NULL ,
    password char(64)    NOT NULL ,
    first_name varchar(50)    NOT NULL ,
    last_name varchar(50)    NOT NULL ,
    picture_id int    NULL ,
    CONSTRAINT user_pk PRIMARY KEY (id)
);

-- Table users_per_team
CREATE TABLE users_per_team (
    id int    NOT NULL  AUTO_INCREMENT,
    user_id int    NOT NULL ,
    team_id int    NOT NULL ,
    CONSTRAINT users_per_team_pk PRIMARY KEY (id)
);

-- Table videos_per_project
CREATE TABLE videos_per_project (
    id int    NOT NULL  AUTO_INCREMENT,
    project_id int    NOT NULL ,
    url text    NOT NULL ,
    title varchar(50)    NULL ,
    description text    NULL ,
    CONSTRAINT videos_per_project_pk PRIMARY KEY (id)
);

-- Table portfolio
CREATE TABLE portfolio (
    id int    NOT NULL  AUTO_INCREMENT,
    user_id int    NOT NULL ,
    layout enum('List','Grid')    NOT NULL DEFAULT 'List' ,
    CONSTRAINT portfolio_pk PRIMARY KEY (id)
);





-- foreign keys
-- Reference:  group_team (table: folder)


ALTER TABLE folder ADD CONSTRAINT group_team FOREIGN KEY group_team (team_id)
    REFERENCES team (id);
-- Reference:  group_user (table: folder)


ALTER TABLE folder ADD CONSTRAINT group_user FOREIGN KEY group_user (user_id)
    REFERENCES user (id);
-- Reference:  links_per_project_project (table: links_per_project)


ALTER TABLE links_per_project ADD CONSTRAINT links_per_project_project FOREIGN KEY links_per_project_project (project_id)
    REFERENCES project (id);
-- Reference:  pictures_per_project_picture (table: pictures_per_project)


ALTER TABLE pictures_per_project ADD CONSTRAINT pictures_per_project_picture FOREIGN KEY pictures_per_project_picture (picture_id)
    REFERENCES picture (id);
-- Reference:  pictures_per_project_project (table: pictures_per_project)


ALTER TABLE pictures_per_project ADD CONSTRAINT pictures_per_project_project FOREIGN KEY pictures_per_project_project (project_id)
    REFERENCES project (id);
-- Reference:  project_folder (table: project)


ALTER TABLE project ADD CONSTRAINT project_folder FOREIGN KEY project_folder (folder_id)
    REFERENCES folder (id);
-- Reference:  project_picture (table: project)


ALTER TABLE project ADD CONSTRAINT project_picture FOREIGN KEY project_picture (picture_id)
    REFERENCES picture (id);
-- Reference:  project_team (table: project)


ALTER TABLE project ADD CONSTRAINT project_team FOREIGN KEY project_team (team_id)
    REFERENCES team (id);
-- Reference:  project_user (table: project)


ALTER TABLE project ADD CONSTRAINT project_user FOREIGN KEY project_user (user_id)
    REFERENCES user (id);
-- Reference:  subscription_plan (table: subscription)


ALTER TABLE subscription ADD CONSTRAINT subscription_plan FOREIGN KEY subscription_plan (plan_id)
    REFERENCES plan (id);
-- Reference:  subscription_user (table: subscription)


ALTER TABLE subscription ADD CONSTRAINT subscription_user FOREIGN KEY subscription_user (user_id)
    REFERENCES user (id);
-- Reference:  team_picture (table: team)


ALTER TABLE team ADD CONSTRAINT team_picture FOREIGN KEY team_picture (picture_id)
    REFERENCES picture (id);
-- Reference:  user_picture (table: user)


ALTER TABLE user ADD CONSTRAINT user_picture FOREIGN KEY user_picture (picture_id)
    REFERENCES picture (id);
-- Reference:  users_per_team_team (table: users_per_team)


ALTER TABLE users_per_team ADD CONSTRAINT users_per_team_team FOREIGN KEY users_per_team_team (team_id)
    REFERENCES team (id);
-- Reference:  users_per_team_user (table: users_per_team)


ALTER TABLE users_per_team ADD CONSTRAINT users_per_team_user FOREIGN KEY users_per_team_user (user_id)
    REFERENCES user (id);
-- Reference:  videos_per_project_project (table: videos_per_project)


ALTER TABLE videos_per_project ADD CONSTRAINT videos_per_project_project FOREIGN KEY videos_per_project_project (project_id)
    REFERENCES project (id);
-- Reference:  portfolio_user (table: portfolio_user)


ALTER TABLE portfolio ADD CONSTRAINT portfolio_user FOREIGN KEY portfolio_user (user_id)
    REFERENCES user (id);



-- End of file.

