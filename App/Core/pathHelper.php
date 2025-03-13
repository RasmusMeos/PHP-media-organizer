<?php

function base_path($path = '') {
  return dirname(__DIR__,2) . '/' . ltrim($path, '/');
}
