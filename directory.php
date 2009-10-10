<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>NU Directory Scraper</title>
	
</head>
<body>


<?php

if(isset($_POST['namelist']))
{
  include 'nuDirectoryEntry.php';
  $names = explode(",", $_POST['namelist']);

  foreach ($names as $name)
  {
    $person = new nuDirectoryEntry($name);
    echo "<p>" . $person->name . "<br />";
    echo $person->phone . "<br />";
    echo $person->address . "</p>";
  }
}

?>
<form method="post" action="<?php echo $PHP_SELF;?>">
Names (separate by comma)<input type="text" size="40" name="namelist"><br />
<input type="submit" value="submit" name="submit">
</form>
</body>
</html>
