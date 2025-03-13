CREATE TABLE users (
    user_id integer PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    screen_name VARCHAR(255) DEFAULT NULL, -- Visible name, default equals username
    email VARCHAR(255) NOT NULL UNIQUE,
    pwd VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE media (
                     media_id integer PRIMARY KEY AUTOINCREMENT,
                     media_name VARCHAR(255) NOT NULL,
                     mime_type VARCHAR(50) NOT NULL,
                     file_size BIGINT NOT NULL,
                     file_name VARCHAR(255) NOT NULL,
                     download_url VARCHAR(255), -- for future drag-and-drop functionality
                     media_description TEXT,
                     taken_date TIMESTAMP,
                     created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE folders (
                       folder_id integer PRIMARY KEY AUTOINCREMENT,
                       folder_name VARCHAR(255) NOT NULL,
                       folder_description TEXT,
                       created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE invitations (
                           invite_id integer PRIMARY KEY AUTOINCREMENT,
                           folder_id INT REFERENCES folders(folder_id) ON DELETE CASCADE,
                           invited_user_id INT REFERENCES users(user_id) ON DELETE CASCADE,
                           sender_user_id INT REFERENCES users(user_id) ON DELETE CASCADE,
                           status VARCHAR(50) NOT NULL DEFAULT 'pending',
                           created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users_media (
                           media_id INT REFERENCES media(media_id) ON DELETE CASCADE,
                           user_id INT REFERENCES users(user_id) ON DELETE CASCADE,
                           PRIMARY KEY (media_id, user_id)
);

CREATE TABLE users_folders (
                             user_id INT REFERENCES users(user_id) ON DELETE CASCADE,
                             folder_id INT REFERENCES folders(folder_id) ON DELETE CASCADE,
                             is_admin BOOLEAN NOT NULL DEFAULT FALSE,
                             PRIMARY KEY (user_id, folder_id)
);

CREATE TABLE folder_media (
                            folder_id INT REFERENCES folders(folder_id) ON DELETE CASCADE,
                            media_id INT REFERENCES media(media_id) ON DELETE CASCADE,
                            PRIMARY KEY (folder_id, media_id)
);

CREATE TABLE favourite_media (
                               user_id INT REFERENCES users(user_id) ON DELETE CASCADE,
                               media_id INT REFERENCES media(media_id) ON DELETE CASCADE,
                               PRIMARY KEY (user_id, media_id)
);
