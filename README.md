# PHP-media-organizer #

#### Document root: /path/to/apache/document/root/PHP-media-organizer/public ####
The placeholder __/path/to/apache/document/root__ refers to __/opt/homebrew/var/www__ for example.

## Demo version database schema ## 
```sql
-- Users table: stores user information
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);

-- Images table: stores information about each image
CREATE TABLE images (
    image_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    image_name VARCHAR(255) NOT NULL,
    taken_date DATETIME NULL,
    upload_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    file_path VARCHAR(255) NOT NULL,
    favorite BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Folders table: stores information about folders
CREATE TABLE folders (
    folder_id INT PRIMARY KEY AUTO_INCREMENT,
    folder_name VARCHAR(255) NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Folder-Image relationship table: links images to folders (many-to-many)
CREATE TABLE folder_images (
    folder_id INT,
    image_id INT,
    PRIMARY KEY (folder_id, image_id),
    FOREIGN KEY (folder_id) REFERENCES folders(folder_id) ON DELETE CASCADE,
    FOREIGN KEY (image_id) REFERENCES images(image_id) ON DELETE CASCADE
);
```


## Proposed final version database schema ## 

### 1. Users Table ###
This table stores information about users.
```sql
CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    user_name VARCHAR(255) NOT NULL DEFAULT '', -- Visible name, default equals username
    email VARCHAR(255) NOT NULL UNIQUE,
    pwd VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
```

### 2. Media Table ###
This table stores media files (images, videos, etc.).
```sql
CREATE TABLE media (
    media_id SERIAL PRIMARY KEY,
    media_name VARCHAR(255) NOT NULL,
    mime_type VARCHAR(50) NOT NULL,
    file_size BIGINT NOT NULL,
    taken_date TIMESTAMP,
    upload_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    file_path VARCHAR(255) NOT NULL,
    download_url VARCHAR(255), -- for future drag-and-drop functionality
    media_description TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
```

### 3. Folders Table ###
This table allows users to organize their media into folders (can also be referred to as 'groups').
```sql
CREATE TABLE folders (
    folder_id SERIAL PRIMARY KEY,
    folder_name VARCHAR(255) NOT NULL,
    folder_description TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
```

### 4. Invitations Table ###
This table tracks group invitations sent between users for shared folders.
```sql
CREATE TABLE invitations (
    invite_id SERIAL PRIMARY KEY,
    folder_id INT REFERENCES folders(folder_id) ON DELETE CASCADE,
    invited_user_id INT REFERENCES users(user_id) ON DELETE CASCADE,
    sender_user_id INT REFERENCES users(user_id) ON DELETE CASCADE,
    status VARCHAR(50) NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
```

### 5. Media Ownership Table ###
This linking table tracks ownership of media by users.

```sql
CREATE TABLE media_users (
    media_id INT REFERENCES media(media_id) ON DELETE CASCADE,
    user_id INT REFERENCES users(user_id) ON DELETE CASCADE,
    PRIMARY KEY (media_id, user_id)
);
```

### 6. Folder Media Table ###
This linking table connects media with folders.
```sql
CREATE TABLE folder_media (
    folder_id INT REFERENCES folders(folder_id) ON DELETE CASCADE,
    media_id INT REFERENCES media(media_id) ON DELETE CASCADE,
    PRIMARY KEY (folder_id, media_id)
);
```

### 7. Favorites Table ###
This table tracks the media that users have marked as favorites.
```sql
CREATE TABLE favorite_media (
    user_id INT REFERENCES users(user_id) ON DELETE CASCADE,
    media_id INT REFERENCES media(media_id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, media_id)
);
```




