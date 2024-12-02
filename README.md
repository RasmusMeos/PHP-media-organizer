# PHP-media-organizer #

### Document root: _/path/to/apache/document/root/PHP-media-organizer/public_ ###
The placeholder _/path/to/apache/document/root_ refers to _/opt/homebrew/var/www_ for example.

## Final version database schema ##

### 1. Users Table ###
This table stores information about users.
```sql
CREATE TABLE users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    screen_name VARCHAR(255) NOT NULL DEFAULT '', -- Visible name, default equals username
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
    file_name VARCHAR(255) NOT NULL,
    download_url VARCHAR(255), -- for future drag-and-drop functionality
    media_description TEXT,
    taken_date TIMESTAMP,
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
CREATE TABLE users_media (
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

## Functional Requirements written as User stories ##

User story, Wikipedia definition:\
_"In software development and product management, a user story is an informal, natural language description of features of a software system. They are written from the perspective of an end user or user of a system, and may be recorded on index cards, Post-it notes, or digitally in specific management software."_

In theory, we could obtain this information from a "hypothetical" client.

_"We gather user stories through various user research methods such as interviews, questionnaires, observations, and others."_ - Chisel Labs

### User Account Management ###

- **FR1:** As a user, I want to create an account so I can access the platform and organize my media.
- **FR2:** As a user, I want to log into my account securely so I can access my uploaded content.
- **FR3:** As a user, I want to log out from my account to keep my media safe when I'm done.

### Media Upload & Management ###

- **FR4:** As a user, I want to upload media to the platform to organize and store my content.
- **FR5:** As a user, I want the platform to automatically detect when my media files (e.g., photos) were taken and save this information.
- **FR6:** As a user, I want to view all my uploaded media in a gallery format on my homepage, so I can easily browse my collection.
- **FR7:** As a user, I want to delete media that I no longer need to keep my gallery clean and organized.
- **FR8:** As a user, I want to rename media after it is uploaded, giving it a more meaningful name.
- **FR9:** As a user, I want to view media files in fullscreen to better see the details.
- **FR10:** As a user, I want to filter or search media by date, name, or type (e.g., images, videos) to quickly find what I’m looking for.

### Favorites ###

- **FR11:** As a user, I want to mark media as "favorites" so that I can filter and easily access my favorite content.
- **FR12:** As a user, I want a "Favorites" section that automatically displays my favorited media without manually moving them.

### Folders ###

- **FR13:** As a user, I want to create folders to organize my media files into categories.
- **FR14:** As a user, I want to move media between folders to keep them better organized.
- **FR15:** As a user, I want to rename folders to better reflect their purpose.
- **FR16:** As a user, I want to delete folders I no longer need, with the option to either keep the media accessible or delete the media along with the folder.

### Groups & Group Management ###

- **FR17:** As a user, I want to create a shared space (group) for multiple users to contribute and view shared media in one place.
- **FR18:** As a group owner, I want to manage group membership by adding or removing members, and have control over all shared media.
- **FR19:** As a group member, I want to upload media to the group but only have the ability to delete media that I uploaded.
- **FR20:** As a group member, I want to invite others to join the group so we can collaborate.
- **FR21:** As a group owner or member, I want to be able to view all group-shared media in a dedicated section for better interaction.

### Invitations ###

- **FR22:** As a group owner, I want to invite other users to join the group, so they can access and contribute to the shared content.
- **FR23:** As a user, I want to accept or decline group invitations so I can decide which groups I want to participate in.

### Optional/Future Features ###

- **FR24:** As a user, I want to download media from the platform so that I can store it locally.
- **FR25:** As a user, I want to manage the privacy of my media, setting some files as "public" for others to view if I choose.
- **FR26:** As a user, I want to upload multiple media, so I can transfer large quantities of files at once.
- **FR27:** As a user, I want to be able change the language of the app, so I can better understand its contents.
- **FR28:** As a user, I want to change my on-screen name, so others can recognize me better.

## Demo (old) version database schema ##
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

-- folder-Image relationship table: links images to folders (many-to-many)
CREATE TABLE folder_images (
    folder_id INT,
    image_id INT,
    PRIMARY KEY (folder_id, image_id),
    FOREIGN KEY (folder_id) REFERENCES folders(folder_id) ON DELETE CASCADE,
    FOREIGN KEY (image_id) REFERENCES images(image_id) ON DELETE CASCADE
);
```




