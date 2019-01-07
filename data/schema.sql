CREATE TABLE post ( id INTEGER PRIMARY KEY AUTOINCREMENT, title varchar(100) NOT NULL, content TEXT NOT NULL);
insert into post(title, content) values('Post 1', 'Content 1');
insert into post(title, content) values('Post 2', 'Content 2');
insert into post(title, content) values('Post 3', 'Content 3');
insert into post(title, content) values('Post 4', 'Content 4');

CREATE TABLE users
(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  username VARCHAR (100) UNIQUE NOT NULL,
  password VARCHAR (60),
  full_name VARCHAR (150) NOT NULL,
);

INSERT INTO users(username, password, full_name)
  values(
    'armandojrn@hotmail.com',
    '$2y$10$SP3RbQfbLqIpZ1Csd57MlexuzFPR1tPshYe7dree1lWbyXxCzv1uy',
    'Armando Nascimento Junior');

-- GERAR SENHA
--  php -r "echo password_hash('123456', PASSWORD_BCRYPT);" = $2y$10$SP3RbQfbLqIpZ1Csd57MlexuzFPR1tPshYe7dree1lWbyXxCzv1uy
-- password_hash('123456', PASSWORD_ARGON2I, ['memory_cost' => 1<<18, 'time_cost' => 4, 'threads' => 4])
-- DELETAR BANCO SQLITE
-- rm data/blog.db

-- ?????????????
-- touch data/blog.db