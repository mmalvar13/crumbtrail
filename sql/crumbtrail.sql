/*  This is just a quick template.

DROP TABLE IF EXISTS ***

CREATE TABLE *** (
	*** INT UNSIGNED AUTO_INCREMENT NOT NULL,
	*** VARCHAR(128) NOT NULL,
	PRIMARY KEY(**)
));

CREATE TABLE ***** (
	-- This is a weak entity, which specifies the many-to-many
	-- relationship between *** and ***.
	******Id INT UNSIGNED NOT NULL,
	****** INT UNSIGNED NOT NULL,
	INDEX(******),
	INDEX(******),
	FOREIGN KEY(***) REFERENCES ***(****),
	FOREIGN KEY(***) REFERENCES ***(****),
	PRIMARY KEY(****, ****)
);
