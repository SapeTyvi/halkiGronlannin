
CREATE TABLE blogPosts(
blogId int AUTOINCREMENT,
subject varchar(100) NOT NULL,
content blob(medium) NOT NULL,
PRIMARY KEY (blogId);

CREATE TABLE blogComments(
blogId int,
cId int AUTOINCREMENT,
userName varchar(50),
email varchar(50),
message blob,

PRIMARY KEY (cId),
FOREIGN KEY (blogId) REFERENCES blogPosts(blogId),
);

CREATE TABLE commentAnswers(
aId int AUTOINCREMENT,
cId int,
userName varchar(50),
email varchar(50),
message blob,

PRIMARY KEY (aId),
FOREIGN KEY (cId) REFERENCES blogComments(cId),
);
