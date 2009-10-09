<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>NU Directory Scraper</title>
	
</head>
<body>

<?php
function fetchData( $name ) {
  $name_encoded = urlencode($name);

  $html = file_get_contents("http://directory.northwestern.edu/index.cgi?a=1&name=$name_encoded");

  $dom = new domDocument;
  $dom->loadHTML($html);
  $dom->preserveWhiteSpace = true;
  $div = $dom->getElementById('content-body');
  $tables = $div->getElementsByTagName('table');
  $table = $tables->item(0);
  $rows = $table->getElementsByTagName('tr');
  $cols = $rows->item(1)->getElementsByTagName('td');
  $person['address'] = nl2br($cols->item(2)->nodeValue);
  $person['phone'] = $cols->item(1)->nodeValue;

  $person['name'] = $name;

  return $person;
}

//$names = array('Cary Lee', 'Kaitlin Very', 'Nathan Ritter', 'Luis de la Torre', 'Jennifer Jenkins');

if(isset($_POST['namelist'])) {
  $names = explode(",", $_POST['namelist']);

foreach ($names as $name ) {
  $person = fetchData($name);
  echo "<p>" . $person['name'] . "<br />";
  echo $person['phone'] . "<br />";
  echo $person['address'] . "</p>";
}

}

?>
<form method="post" action="<?php echo $PHP_SELF;?>">
Names (separate by comma)<input type="text" size="40" name="namelist"><br />
<input type="submit" value="submit" name="submit">
</form>
</body>
</html>

