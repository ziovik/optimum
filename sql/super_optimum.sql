drop database if exists super_optimum;
create database super_optimum;

use super_optimum;

-- roles table
create table role (
  id int not null auto_increment,
  name varchar(10) unique not null,

  primary key (id)
);

insert into role values
  (1, 'admin'),
  (2, 'user');

create table credentials (
  id int not null auto_increment,
  login varchar(30) unique not null,
  password varchar(100) not null,
  role_id int not null,

  primary key (id)
);

insert into credentials values
  (1, 'admin', 'admin', 1),
  (2, 'alex', 'alex', 2),
  (3, 'daniel', 'daniel', 2),
  (4, 'apple', 'apple', 2),
  (5, 'avon', 'avon', 2),
  (6, 'reebok', 'reebok', 2);

-- country table
create table country (
  id bigint not null auto_increment,
  name varchar (100) unique not null,

  primary key (id)
);

insert into country (id, name) values
  (1, 'Россия'),
  (2, 'США');

-- region table --
create table region (
  id bigint not null auto_increment,
  name varchar(255) unique not null,
  code int unique not null,
  country_id bigint not null,

  primary key (id),
  foreign key (country_id) references country (id)
);

insert into region(id, name, code, country_id) values
  (1, 'Курск', 46, 1),
  (2, 'Белгород', 31, 1),
  (3, 'Воронеж', 36, 1),
  (4, 'Сан-Франциско', 49, 2),
  (5, 'Вашингтон', 50, 2);

-- street table
create table street (
  id bigint not null auto_increment,
  name varchar(255) unique not null,
  region_id bigint not null,

  primary key (id),
  foreign key(region_id) references region (id)
);

insert into street values
  (1, 'Ленина', 1),
  (2, 'Радищева', 1),
  (3, 'Харьковская', 2),
  (4, 'Шишкова', 3),
  (5, 'Хилтон Роуз', 4),
  (6, 'Рузвельт стрит', 5);

-- address table, address_id
create table address (
  id bigint not null auto_increment,
  index_code varchar(10) not null,
  street_id bigint not null,
  building varchar(10) not null,
  house varchar(10),

  primary key (id),
  foreign key (street_id) references street (id)
);

insert into address (id, index_code, street_id, building, house) values
  (1, '102020', 1, 10, 1), -- it's Daniel address
  (2, '305020', 2, 3, null),
  (3, '234345', 3, 104, null),
  (4, '232232', 4, 34, null), -- its Alex addres
  (5, '343434344', 5, 123, 2),
  (6, '244435', 6, 12, null);

-- table company --
create table company (
  id bigint not null auto_increment,
  name varchar(255) not null,
  ogrn varchar(255) not null,
  inn varchar(255) not null,

  primary key (id)
);

insert into company (id, name, ogrn, inn) values
  (1, 'Apple', '123-24-234', '234-34-342'),
  (2, 'Avon', '123-24-234', '234-34-342'),
  (3, 'Reebok', '123-24-234', '234-34-342'),
  (4, 'Daniel Monday SUper Man', '123-24-234', '234-34-342');

-- contact table --
create table contact (
  id bigint not null auto_increment,
  email varchar(255) not null,
  telephone varchar(50) not null,

  primary key (id)
);

insert into contact (id, email, telephone) values
  (1, 'alex@yahoo.com', '34-43-43'),
  (2, 'dan@gmail.com', '44-55-66'),
  (3, 'apple@gmail.com', '342-23-45'),
  (4, 'avon@rambler.com', '11-12-36'),
  (5, 'reebok@yahoo.com', '3432-234345-345');

-- table customer
create table customer (
  id bigint not null auto_increment,
  name varchar(255) not null,
  company_id bigint,
  contact_id bigint not null,
  region_id bigint not null,
  address_id bigint not null,
  credentials_id int unique not null,

  primary key (id),
  foreign key (company_id) references company (id),
  foreign key (contact_id) references contact (id),
  foreign key (region_id) references region (id),
  foreign key (address_id) references address (id),
  foreign key (credentials_id) references credentials (id)
);

insert into customer (id, name, company_id, contact_id, region_id, address_id, credentials_id) values
  (1, 'Alex', null, 1, 3, 4, 2), -- 3 is Voronej
  (2, 'Daniel', 4, 2, 1, 1, 3); -- 1 is Kursk

create table distributor (
  id bigint not null auto_increment,
  contact_id bigint not null,
  company_id bigint not null,
  credentials_id int unique not null,
  region_id bigint not null, -- hometown of distr
  address_id bigint not null,

  primary key (id),
  foreign key (company_id) references company (id),
  foreign key (contact_id) references contact (id),
  foreign key (credentials_id) references credentials (id),
  foreign key (region_id) references region (id),
  foreign key (address_id) references address (id)
);

insert into distributor (id, contact_id, company_id, credentials_id, region_id, address_id) values
  (1, 3, 1, 4, 4, 5), -- Apple (from San-Fransisco)
  (2, 4, 2, 5, 5, 6), -- Avon (from Washington)
  (3, 5, 3, 6, 5, 6); -- Reebok (from Washington)

-- store place of products
create table store (
  region_id bigint not null,
  distributor_id bigint not null,

  foreign key (region_id) references region (id),
  foreign key (distributor_id) references distributor(id)
);

insert into store (region_id, distributor_id) values
  (1, 1), -- Apple Store in Kursk
  (2, 1), -- Apple Store in Belgorod,

  (1, 2), -- Avon store in Kursk
  (3, 2), -- Avon store in Voronej

  (1, 3), -- Reebook store in Kursk
  (2, 3), -- Reebook store in Belgorod
  (3, 3); -- Reebook store in Voronej


create table category (
  id bigint not null auto_increment,
  name varchar(255) unique not null,

  primary key (id)
);

insert into category values
  (1, 'Косметика'),
  (2, 'Электроника'),
  (3, 'Одежда');

create table sub_category (
  id bigint not null auto_increment,
  name varchar(255) unique not null,
  category_id bigint not null,

  primary key (id),
  foreign key (category_id) references category (id)
);

insert into sub_category values
  (1, 'Крем', 1),
  (2, 'Помада', 1),

  (3, 'Смартфоны', 2),
  (4, 'Ноутбуки', 2),

  (5, 'Футболки', 3),
  (6, 'Кроссовки', 3);

create table product (
  id bigint not null auto_increment,
  name varchar(255) unique not null,
  description varchar(255),
  manufacturer varchar(255),
  keyword varchar(255),
  price double not null,

  min_order double,
  max_order double,
  discount double,
  expired date,
  code varchar(50),

  distributor_id bigint not null,
  sub_category_id bigint not null,

  primary key (id),
  foreign key (distributor_id) references distributor (id),
  foreign key (sub_category_id) references sub_category (id)
);

insert  into product (id, name, description, manufacturer, keyword, price, distributor_id, sub_category_id) value
  (1, 'Крем для бритья', null, null, null, 100, 2, 1),
  (2, 'Крем для рук', null, null, null, 8, 2, 1),

  (3, 'iPhone 10', null, null, null, 300, 1, 3),
  (4, 'iMac', null, null, null, 1000, 1, 4),

  (5, 'Крутая красная футболка', null, null, null, 100, 3, 5),
  (6, 'Очень классные синие шорты', null, null, null, 80, 3, 6);

create table simple_order (
  id bigint not null auto_increment,
  registration_date datetime not null,

  primary key (id)
);

insert into simple_order values
  (1, now() - interval 10 day), -- my order in past
  (2, now()), -- my order
  (3, now() + interval 3 day); -- your order

-- cart table --
create table cart (
  id bigint not null auto_increment,
  customer_id bigint not null,
  status varchar(20) not null, -- active/inactive (inactive is in history)

  primary key (id),
  foreign key (customer_id) references customer(id)
);

insert into cart (id, customer_id, status) values
  (1, 1, 'inacitve'), -- my cart in past
  (2, 1, 'active'), -- it's only my cart
  (3, 2, 'active'); -- it's only your cart

-- product_item table --
create table product_item (
  id bigint not null auto_increment,
  product_id bigint not null,
  quantity double not null,
  cart_id bigint not null,

  primary key (id),
  foreign key (product_id) references product(id),
  foreign key (cart_id) references cart(id)
);

insert  into product_item (id, product_id, quantity, cart_id) values
  (1, 2, 1, 1), -- i bought cream for hands in past
  (2, 6, 3, 1), -- i bought 3 pans in past

  (3, 1, 2, 1), -- shaving cream 2 items (my cart)
  (4, 3, 1, 1), -- iphone10 1 item (my cart)

  (5, 5, 1, 2), -- one red t-shirt (your cart)
  (6, 4, 3, 2); -- three imacs (your cart)


create table cart_n_order (
  simple_order_id bigint not null,
  cart_id bigint not null,

  foreign key (simple_order_id) references simple_order(id),
  foreign key (cart_id) references cart (id)
);

insert into cart_n_order(simple_order_id, cart_id) values
  (1, 1), -- my cart in first order in past,
  (2, 3), -- your cart now
  (3, 2); -- my cart now