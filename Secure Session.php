session_start();
session_regenerate_id(true); // Regenerate session ID

// Set secure session cookies
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => 'yourdomain.com',
    'secure' => true, // Only send over HTTPS
    'httponly' => true, // Prevent JavaScript access
    'samesite' => 'Strict' // Prevent CSRF
]);
