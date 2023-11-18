create table tbl_company(
    company_id int not null PRIMARY KEY AUTO_INCREMENT,
    company_name varchar(50)
);

CREATE TABLE tbl_depart (
    depart_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    company_id int,
    depart_name varchar(150),
    FOREIGN KEY (company_id) REFERENCES tbl_company(company_id)
);
 
create table tbl_position (
    position_id int not null PRIMARY KEY AUTO_INCREMENT,
    position_name varchar(150),
    company_id int,
    depart_id int, 
    FOREIGN KEY (company_id) REFERENCES tbl_company(company_id),
    FOREIGN KEY (depart_id) REFERENCES tbl_depart(depart_id)
);

CREATE TABLE tbl_header_title (
    header_title_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    header_title_name varchar(300)
);

INSERT INTO tbl_header_title (header_title_id, header_title_name) VALUES
(1, 'ລະບົບ'),
(2, 'ບຸກຄົນ'),
(3, 'ຄຳຂໍ'),
(4, 'ການເງິນ'),
(5, 'ແຈ້ງບັນຫາ'), 
(6, 'ລາຍງານ');


CREATE TABLE tbl_sub_header (
    sub_header_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    sub_header_name varchar(300),
    icon_code varchar(100),
    header_title_id int
);

CREATE TABLE tbl_page_title (
    page_title_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    page_title_name varchar(300),
    page_title_file_name varchar(100),
    sub_header_id int
);

CREATE TABLE tbl_roles (
    role_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    role_name varchar(150)
);

CREATE TABLE tbl_role_use_page (
    role_use_page_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    role_id int,
    header_title_id int,
    sub_header_id int,
    page_title_id int,
    FOREIGN KEY (page_title_id) REFERENCES tbl_page_title(page_title_id)
);

CREATE TABLE tbl_user (
    user_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    full_name varchar(300),
    user_name varchar(30),
    user_password varchar(30),
    role_id int,
    company_id int,
    depart_id int,
    user_status int,
    add_by int,
    date_add date,
    FOREIGN KEY (company_id) REFERENCES tbl_company(company_id),
    FOREIGN KEY (role_id) REFERENCES tbl_roles(role_id),
    FOREIGN KEY (depart_id) REFERENCES tbl_depart(depart_id)
);


create table tbl_sms_message_data(
    sms_message_data_id int not null PRIMARY KEY AUTO_INCREMENT,
    sms_message_data_detail text,
    sms_message_data_status int,
    date_add date,
    add_by int
);