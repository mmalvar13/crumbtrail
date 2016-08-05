-- drop tables in reverse order to start fresh every time

DROP TABLE IF EXISTS ???;
DROP TABLE IF EXISTS ?????;
DROP TABLE IF EXISTS ?????;
DROP TABLE IF EXISTS ?????;
DROP TABLE IF EXISTS ?????;


CREATE TABLE profile(
	-- always start with your primary keys first!
	-- make it of size and type INT, give it auto increment because it's a primary key, and require a value so use NOT NULL

	profileId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	-- now create other attributes within profileId
	profileName VARCHAR(128) NOT NULL,
	profileEmail VARCHAR(128) NOT NULL ,
	profilePhone VARCHAR(32) NOT NULL ,

	profileActiationToken VARCHAR(128), -- look into this one,  see if data type and initial Null value is ok. ask dylan if correct!!!*****

	profileType VARCHAR()




)