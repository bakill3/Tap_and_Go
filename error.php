<?php
if(isset($_GET['error'])) {
    echo "Error: " . htmlspecialchars($_GET['error']);
}
?>
