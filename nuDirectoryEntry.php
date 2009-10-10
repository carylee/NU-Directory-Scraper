<?php

define('BASEURL', 'http://tlab-login.cs.northwestern.edu/~cel294/NU-Directory-Scraper/fetch.php?q=');

class nuDirectoryEntry {

  function __construct($name) {

    $name_encoded = urlencode($name);
    $html = file_get_contents(BASEURL . $name_encoded);
    $dom = new domDocument;
    $dom->loadHTML($html);
    $div = $dom->getElementById('content-body');
    $table = $div->getElementsByTagName('table')->item(0);
    $rows = $table->getElementsByTagName('tr');
    $cols = $rows->item(1)->getElementsByTagName('td');
    $this->address = nl2br($cols->item(2)->nodeValue);
    $this->phone = $cols->item(1)->nodeValue . "<br />";
    $this->name = $name;
  }
}

?>
