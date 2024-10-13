<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

// Set session cookie parameters
session_set_cookie_params([
  'lifetime' => 1800,
  'domain' => 'rasmus.meos.ee',
  'path' => '/',
  'secure' => true,
  'httponly' => true,
]);

session_start();

// Regenerate session ID
if (!isset($_SESSION["last_regeneration"])) {
  regenerateSessionID();
} else {
  $interval = 60 * 120; // 2 tundi
  if (time() - $_SESSION["last_regeneration"] > $interval) {
    regenerateSessionID();
  }
}

function regenerateSessionID() {
  session_regenerate_id(true);
  $_SESSION["last_regeneration"] = time();
}

