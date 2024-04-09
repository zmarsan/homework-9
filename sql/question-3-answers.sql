-- select by id 1:

select * from posts where id = 1;

-- select all posts where title = includes "title 2":

select * from posts where title like "%title 2%"
-- select all posts and order by the title column alphabetically:

select * from posts order by name ASC;

-- insert 3 new posts

insert into posts (title, description) values
('post1', 'description'),
('post2', 'description2'),
('post3', 'description3');


-- update posts where id = 1, set the title to "new title"

update posts set name = 'updated' where id = 1

-- delete post where id = 2

delete from posts where id = 2
