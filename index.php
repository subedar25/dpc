<?php

// Shared front controller for environments where the web root is the project root.
// Local dev can still use public/index.php directly.
if (! defined('FCPATH')) {
    define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
}

require FCPATH . 'index.php';
