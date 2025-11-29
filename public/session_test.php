<?php
// Session test
echo "<h1>Session Test</h1>";
echo "<p>Current session data:</p>";
echo "<pre>";
print_r(session()->get());
echo "</pre>";

echo "<p>All session data:</p>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<hr>";
echo "<p><a href='index.php'>Back to Application</a></p>";
?>
