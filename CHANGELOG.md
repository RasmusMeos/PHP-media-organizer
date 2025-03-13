# PHP Media Organizer Changelog

## v1.0.0

### Overview
This changelog highlights the features available in the PHP Media Organizer project as of version 1.0.0.

### New Features

#### User Account Management
- **Account Creation:** Users can create accounts to access the platform and organize their media.
- **Secure Login:** Users can log in securely to access their uploaded content.
- **Logout:** Users can log out of their accounts to ensure their media remains secure.
- **Change Account Details:** Users can change their password or on-screen name.

#### Media Upload & Management
- **Media Upload:** Users can upload image files to the platform.
- **Automatic Metadata Detection:** This feature automatically detects and saves media creation dates during the upload process.
- **Media Gallery:** Uploaded media are displayed in a vertical gallery format on the homepage, complete with pagination for easy navigation.
- **Media Features:**
    - Users can view media in fullscreen.
    - Users can delete unwanted media to maintain a clean and organized gallery.
    - Users can rename media files after upload for more meaningful identification.
    - Users can mark media as "favourites".

- **Filtering and Searching:**
  - Users can filter media by date, name, or type (e.g., images or videos).
  - A search bar allows looking up media by name and supports partial matches as well as case-insensitivity.
  - Filtering and searching are now integrated with pagination.

#### Favourites Management
- **Favourites Section:** A dedicated "Favourites" section automatically displays all favourited media for quick access.

### Known Issues and Areas for Improvement

#### Metadata Extraction
- **Time Taken Metadata:** Currently, the platform uses `DateTimeOriginal` to detect the time when media was taken. However, this metadata field may vary depending on the device, which can result in the date not being picked up for some media files. Supporting additional metadata fields could improve this functionality.

#### Search Functionality
- **Case Sensitivity Across Databases:** While `ILIKE` ensures case-insensitive searches in PostgreSQL, compatibility issues may arise if switching to a different database system.

#### Session Management
- **Inconsistent Session Termination:** Session generation and management rely on PHP cookies and the `$_SESSION` superglobal. The sessions tend to terminate early, requiring the user to log in again.

#### Access Control
- **Centralized Access Control:** Currently, some pages are available for guest users which are not allowed. Future updates could involve creating a centralized access control by using middleware.


---

### Usage
This changelog reflects the current feature set of the PHP Media Organizer project as of version 1.0.0. Updates will be added as new features are introduced or existing features are enhanced.
