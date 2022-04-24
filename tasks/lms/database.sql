CREATE TABLE if not exists users (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    hash VARCHAR(120) NOT NULL,
    access INT(11) NOT NULL,
    register_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT username_unique UNIQUE (username)
);

CREATE TABLE  if not exists courses(
    id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL,
    questions VARCHAR(100) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE if not exists users_courses (
    id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id SMALLINT UNSIGNED NOT NULL,
    course_note VARCHAR(100),
    course_id SMALLINT UNSIGNED NOT NULL,
    last_question_id SMALLINT NOT NULL,
    questions_data JSON NOT NULL,
    register_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `users_course`
        FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT
);

INSERT INTO courses (name, slug, questions) VALUES ('test1', 'test1', 'questions.yml'),
                                                   ('test2', 'test2', 'questions.yml'),
                                                   ('test3', 'test3', 'questions.yml');
INSERT INTO users (username, hash, access) VALUES ('admin', 'pbkdf2:sha256:260000$1WsDeZPui43CSDcf$ef1325d25d2ff417997c08d8e0b539aad02f7f8de4b88bacbd3cf7b9985de0ed', 0),
                                                  ('test', 'pbkdf2:sha256:260000$3PFXYumDdUUabtv6$a0da723d9615e1e7c75d3b2f48ced1977bb2c15d24a865dbdf5e1f4a61c76e78', 2);
-- INSERT INTO users_courses (user_id, course_id, last_question_id) VALUES (1, 1, 1);