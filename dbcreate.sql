use team06;

CREATE TABLE `User` (
	`User_ID`	VARCHAR(10)	NOT NULL,
	`User_name`	VARCHAR(5)	NOT NULL,
	`User_password`	VARCHAR(16)	NOT NULL,
	`User_num`	VARCHAR(20)	NOT NULL,
	`User_bio`	VARCHAR(20)	NULL
);

CREATE TABLE `Bookmark` (
	`User_ID`	VARCHAR(10)	NOT NULL,
	`Res_ID`	INT	NOT NULL
);

CREATE TABLE `Restaurant` (
	`Res_ID`	INT	NOT NULL,
	`Res_name`	VARCHAR(10)	NOT NULL,
	`Res_address`	VARCHAR(20)	NOT NULL,
	`Res_img_url`	TINYTEXT	NULL,
	`Category_ID`	INT	NOT NULL
);

CREATE TABLE `Res_rate` (
	`Res_ID`	INT	NOT NULL,
	`User_ID`	VARCHAR(10)	NOT NULL,
	`Res_rating`	INT	NOT NULL,
	`Res_rating_date`	DATE	NOT NULL
);

CREATE TABLE `Res_menu` (
	`Res_menu_ID`	INT	NOT NULL,
	`Res_menu_name`	VARCHAR(20)	NOT NULL,
	`Res_ID`	INT	NOT NULL,
	`Res_menu_price`	INT	NOT NULL
);

CREATE TABLE `Res_review` (
	`Res_review_ID`	INT	NOT NULL,
	`User_ID`	VARCHAR(10)	NOT NULL,
	`Res_ID`	INT	NOT NULL
);

CREATE TABLE `Category` (
	`Category_ID`	INT	NOT NULL,
	`Category_name`	VARCHAR(20)	NOT NULL
);

CREATE TABLE `Hospital` (
	`Hos_ID`	VARCHAR(10)	NOT NULL,
	`Hos_address`	VARCHAR(20)	NOT NULL,
	`Hos_name`	VARCHAR(10)	NOT NULL,
	`Hos_num`	VARCHAR(20)	NOT NULL
);

CREATE TABLE `Pharmacy` (
	`Drug_ID`	VARCHAR(10)	NOT NULL,
	`Drug_address`	VARCHAR(20)	NOT NULL,
	`Drug_name`	VARCHAR(20)	NOT NULL,
	`Drug_num`	VARCHAR(20)	NOT NULL
);

CREATE TABLE `Allergy` (
	`Allergy_ID`	INT	NOT NULL,
	`Allergy_name`	VARCHAR(20)	NOT NULL
);

CREATE TABLE `Res_review_item` (
	`Res_review_item_ID`	INT	NOT NULL,
	`Res_review_template`	VARCHAR(10)	NOT NULL	COMMENT 'ex)별로에요'
);

CREATE TABLE `Res_review_content` (
	`Res_review_ID`	INT	NOT NULL,
	`Res_review_item_ID`	INT	NOT NULL
);

CREATE TABLE `Menu_allergy` (
	`Res_menu_ID`	INT	NOT NULL,
	`Allergy_ID`	INT	NOT NULL
);

CREATE TABLE `User_Allergy` (
	`Allergy_ID`	INT	NOT NULL,
	`User_ID`	VARCHAR(10)	NOT NULL
);

ALTER TABLE `User` ADD CONSTRAINT `PK_USER` PRIMARY KEY (
	`User_ID`
);

ALTER TABLE `Bookmark` ADD CONSTRAINT `PK_BOOKMARK` PRIMARY KEY (
	`User_ID`,
	`Res_ID`
);

ALTER TABLE `Restaurant` ADD CONSTRAINT `PK_RESTAURANT` PRIMARY KEY (
	`Res_ID`
);

ALTER TABLE `Res_rate` ADD CONSTRAINT `PK_RES_RATE` PRIMARY KEY (
	`Res_ID`,
	`User_ID`
);

ALTER TABLE `Res_menu` ADD CONSTRAINT `PK_RES_MENU` PRIMARY KEY (
	`Res_menu_ID`
);

ALTER TABLE `Res_review` ADD CONSTRAINT `PK_RES_REVIEW` PRIMARY KEY (
	`Res_review_ID`
);

ALTER TABLE `Category` ADD CONSTRAINT `PK_CATEGORY` PRIMARY KEY (
	`Category_ID`
);

ALTER TABLE `Hospital` ADD CONSTRAINT `PK_HOSPITAL` PRIMARY KEY (
	`Hos_ID`
);

ALTER TABLE `Pharmacy` ADD CONSTRAINT `PK_PHARMACY` PRIMARY KEY (
	`Drug_ID`
);

ALTER TABLE `Allergy` ADD CONSTRAINT `PK_ALLERGY` PRIMARY KEY (
	`Allergy_ID`
);

ALTER TABLE `Res_review_item` ADD CONSTRAINT `PK_RES_REVIEW_ITEM` PRIMARY KEY (
	`Res_review_item_ID`
);

ALTER TABLE `Res_review_content` ADD CONSTRAINT `PK_RES_REVIEW_CONTENT` PRIMARY KEY (
	`Res_review_ID`,
	`Res_review_item_ID`
);

ALTER TABLE `Menu_allergy` ADD CONSTRAINT `PK_MENU_ALLERGY` PRIMARY KEY (
	`Res_menu_ID`,
	`Allergy_ID`
);

ALTER TABLE `User_Allergy` ADD CONSTRAINT `PK_USER_ALLERGY` PRIMARY KEY (
	`Allergy_ID`,
	`User_ID`
);

ALTER TABLE `Bookmark` ADD CONSTRAINT `FK_User_TO_Bookmark_1` FOREIGN KEY (
	`User_ID`
)
REFERENCES `User` (
	`User_ID`
);

ALTER TABLE `Bookmark` ADD CONSTRAINT `FK_Restaurant_TO_Bookmark_1` FOREIGN KEY (
	`Res_ID`
)
REFERENCES `Restaurant` (
	`Res_ID`
);

ALTER TABLE `Res_rate` ADD CONSTRAINT `FK_Restaurant_TO_Res_rate_1` FOREIGN KEY (
	`Res_ID`
)
REFERENCES `Restaurant` (
	`Res_ID`
);

ALTER TABLE `Res_rate` ADD CONSTRAINT `FK_User_TO_Res_rate_1` FOREIGN KEY (
	`User_ID`
)
REFERENCES `User` (
	`User_ID`
);

ALTER TABLE `Res_review_content` ADD CONSTRAINT `FK_Res_review_TO_Res_review_content_1` FOREIGN KEY (
	`Res_review_ID`
)
REFERENCES `Res_review` (
	`Res_review_ID`
);

ALTER TABLE `Res_review_content` ADD CONSTRAINT `FK_Res_review_item_TO_Res_review_content_1` FOREIGN KEY (
	`Res_review_item_ID`
)
REFERENCES `Res_review_item` (
	`Res_review_item_ID`
);

ALTER TABLE `Menu_allergy` ADD CONSTRAINT `FK_Res_menu_TO_Menu_allergy_1` FOREIGN KEY (
	`Res_menu_ID`
)
REFERENCES `Res_menu` (
	`Res_menu_ID`
);

ALTER TABLE `Menu_allergy` ADD CONSTRAINT `FK_Allergy_TO_Menu_allergy_1` FOREIGN KEY (
	`Allergy_ID`
)
REFERENCES `Allergy` (
	`Allergy_ID`
);

ALTER TABLE `User_Allergy` ADD CONSTRAINT `FK_Allergy_TO_User_Allergy_1` FOREIGN KEY (
	`Allergy_ID`
)
REFERENCES `Allergy` (
	`Allergy_ID`
);

ALTER TABLE `User_Allergy` ADD CONSTRAINT `FK_User_TO_User_Allergy_1` FOREIGN KEY (
	`User_ID`
)
REFERENCES `User` (
	`User_ID`
);

CREATE INDEX category_idx ON Restaurant (Category_ID);