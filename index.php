<?php
if ($_SERVER["REQUEST_URI"] == "/") {
    include 'dashboard.php';
} else {
    return false;
}
?>