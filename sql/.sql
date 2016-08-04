
DROP TABLE IF EXISTS profile;
DROP TABLE IF EXISTS company;
DROP TABLE IF EXISTS image;
DROP TABLE IF EXISTS truck;
DROP

CREATE TABLE author (
	authorId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	authorName VARCHAR(128) NOT NULL,
	PRIMARY KEY(authorId)
);

CREATE TABLE article (
	articleId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	articleDate DATE NOT NULL,
	articleText VARCHAR(10000) NOT NULL,
	articleTitle VARCHAR(128) NOT NULL,
	PRIMARY KEY(articleId)
);

CREATE TABLE media (
	--
	mediaId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	mediaArticleId INT UNSIGNED NOT NULL,
	mediaFilepath VARCHAR(128) NOT NULL,
	INDEX(mediaArticleId),
	FOREIGN KEY(mediaArticleId) REFERENCES article(articleId),
	PRIMARY KEY(mediaId)
);

CREATE TABLE authorship (
	-- This is a weak entity, which specifies the many-to-many
	-- relationship between articleId and authorId.
	authorshipArticleId INT UNSIGNED NOT NULL,
	authorshipAuthorId INT UNSIGNED NOT NULL,
	INDEX(authorshipArticleId),
	INDEX(authorshipAuthorId),
	FOREIGN KEY(authorshipArticleId) REFERENCES article(articleId),
	FOREIGN KEY(authorshipAuthorId) REFERENCES author(authorId),
	PRIMARY KEY(authorshipArticleId, authorshipAuthorId)
);
