<?php

$file = '../uploads/user_images/' . basename($_GET['file']);

if (file_exists($file)) {
  header('Content-Type: ' . mime_content_type($file));
  header('Content-Length: ' . filesize($file));
  readfile($file);
  exit;
} else {
  http_response_code(404);
  echo 'File not found.';
}
