<?php
// example of how to use advanced selector features
include('./lib/simple_html_dom/simple_html_dom.php');

$html = new simple_html_dom();
$html->load_file('./search.html');


$classg = $html->find('div[class=g]');

foreach($classg as $g){
	foreach($g->find('a[class=fl]') as $flclass)
	{
		$flclass->outertext = "";
	}
	echo $g->outertext;
}




$html->clear();
?>