-- drop tables in reverse order to start fresh every time

DROP TABLE IF EXISTS employ;
DROP TABLE IF EXISTS event;
DROP TABLE IF EXISTS truck;
DROP TABLE IF EXISTS image;
DROP TABLE IF EXISTS company;
DROP TABLE IF EXISTS profile;


CREATE TABLE profile (
	-- always start with your primary keys first!
	-- make it of size and type INT, give it auto increment because it's a primary key, and require a value so use NOT NULL

	profileId              INT UNSIGNED AUTO_INCREMENT NOT NULL,
	-- now create other attributes within profileId
	profileName            VARCHAR(128)                NOT NULL,
	profileEmail           VARCHAR(128)                NOT NULL,
	profilePhone           VARCHAR(32)                 NOT NULL,

	profileActivationToken CHAR(32),

	profileType            CHAR(1) NOT NULL,

	profileHash            CHAR(128)                   NOT NULL,
	profileSalt            CHAR(64)                    NOT NULL,

	-- make sure of elements that must be unique
	UNIQUE (profileEmail),
	UNIQUE (profileActivationToken),

	-- declare primary key of profileId
	PRIMARY KEY (profileId)
);

CREATE TABLE company (
	companyId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	companyName VARCHAR(128) NOT NULL,
	companyEmail VARCHAR(128) NOT NULL,
	companyPhone VARCHAR(32) NOT NULL,
	companyPermit VARCHAR(32) NOT NULL,
	companyLicense VARCHAR(32) NOT NULL,
	companyAttn VARCHAR(128) NOT NULL,
	companyStreet1 VARCHAR(128) NOT NULL,
	companyStreet2 VARCHAR(128),
	companyCity VARCHAR(128) NOT NULL,
	companyState CHAR(2) NOT NULL,
	companyZip INT UNSIGNED NOT NULL,
	companyDescription VARCHAR(255),
	companyMenuText TEXT,
	companyActivationToken CHAR(32),
	companyApproved BOOL NOT NULL,

	-- companyAccountCreatorId is a foreign key from profile
	companyAccountCreatorId VARCHAR(128) NOT NULL,
	-- indext for foreign key companyAccountCreatorId
	INDEX (companyAccountCreatorId),
	-- declare foreign key for companyAccountCreatorId
	FOREIGN KEY (companyAccountCreatorId) REFERENCES profile (profileId),

	UNIQUE(companyEmail),
	UNIQUE(companyPermit),
	UNIQUE(companyLicense),
	PRIMARY KEY(companyId)
);

CREATE TABLE image (
	imageId        INT UNSIGNED AUTO_INCREMENT NOT NULL,
	imageCompanyId INT UNSIGNED                NOT NULL,
	imageFileType  VARCHAR(10)                  NOT NULL,
	imageFileName  VARCHAR(255)                NOT NULL,
	INDEX(imageCompanyId),
	FOREIGN KEY(imageCompanyId) REFERENCES company(companyId),
	PRIMARY KEY(imageId)
);

CREATE TABLE truck (
	truckId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	truckCompanyId INT UNSIGNED NOT NULL,
	INDEX(truckCompanyId),
	FOREIGN KEY(truckCompanyId) REFERENCES company(companyId),
	PRIMARY KEY (truckId)
);

CREATE TABLE event(
	eventId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	eventTruckId INT UNSIGNED NOT NULL,
	eventEnd DATETIME NOT NULL,
	eventLocation POINT NOT NULL,
	eventStart DATETIME NOT NULL,
	INDEX(eventTruckId),
	FOREIGN KEY(eventTruckId) REFERENCES truck(truckId),
	PRIMARY KEY(eventId)
);

CREATE TABLE employ(
	employCompanyId INT UNSIGNED NOT NULL,
	employProfileId INT UNSIGNED NOT NULL,
	INDEX(employCompanyId),
	INDEX(employProfileId),
	FOREIGN KEY(employCompanyId) REFERENCES company(companyId),
	FOREIGN KEY(employProfileId) REFERENCES profile(profileId),
	PRIMARY KEY(employCompanyId, employProfileId)
);