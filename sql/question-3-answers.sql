-- select by id 1:
SELECT * FROM post WHERE id = 1;

-- select all posts where title = includes "title 2":
SELECT * FROM post WHERE title LIKE '%title 2%';

-- select all posts and order by the title column alphabetically:
SELECT * FROM post ORDER BY title ASC;

-- insert 3 new posts
INSERT INTO post (title, description) VALUES
('question 3 title 1', 'question 3 description 1'),
('question 3 title 2', 'question 3 description 2'),
('question 3 title 3', 'question 3 description 3');

-- update posts where id = 1, set the title to "Updated Post"
UPDATE post SET title = 'Updated Post' WHERE id = 1;

-- delete post where id = 2
DELETE FROM post WHERE id = 2;