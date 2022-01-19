
<!DOCTYPE html5>
<html>
<body>
<div id="wrapper">
    <h1>Test</h1>

<div id="file_div">
<?php
$folder = "../Login";
if ($dir = opendir($folder))
{
 while (($file = readdir($dir)) !== false)
 {
  echo "<p>".$file."</p>";
  echo "<form method='post' action='delete_file.php'>";
  echo "<input type='hidden' name='file_name' value='".$file."'>";
  echo "<input type='submit' name='delete_file' value='Delete File'>";
  echo "</form>";
 }
 closedir($dir);
}
?>
</div>

</div>
</body>
</html>

