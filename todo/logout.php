<?php
/**
 * Clear session data, destroy the session, and redirect to the 'index.html' page.
 *
 * This script starts or resumes the session, unsets all session variables, destroys the session,
 * and then redirects the user to the 'index.html' page.
 *
 */
session_start();
session_unset();
session_destroy();
header('Location: index.html');
?>
