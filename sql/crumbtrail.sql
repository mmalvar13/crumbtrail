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

	profileActivationToken VARCHAR(128), -- look into this one,  see if data type and initial Null value is ok. ask dylan if correct!!!*****

	profileType            CHAR(1), -- to denote the 3 types of profiles (A-admin, O-owner, E-employee) look into this!!!!!!

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
	companyPermit VARCHAR(128) NOT NULL,
	companyLicense INT UNSIGNED NOT NULL,
	companyAttn VARCHAR(128) NOT NULL,
	companyStreet1 VARCHAR(128) NOT NULL,
	companyStreet2 VARCHAR(128) NOT NULL,
	companyState CHAR(2) NOT NULL,
	companyZip INT UNSIGNED NOT NULL,
	companyDescription VARCHAR(512),
	companyMenuText VARCHAR(512),
	companyActivationToken VARCHAR(128),
	companyApproved BOOL NOT NULL,
	companyAccountCreator VARCHAR(128) NOT NULL,
	UNIQUE(companyEmail),
	UNIQUE(companyPermit),
	UNIQUE(companyLicense),
	PRIMARY KEY(companyId)
);






)