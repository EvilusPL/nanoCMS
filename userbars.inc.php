<?php

class Userbars
{
	public $link = array();		// link array
	public $picture = array();	// picture locations array
	public $userbars_elements = 1;	// how many userbars we want to display?
}

$userbars = new Userbars();

$userbars->link[0]="https://getfedora.org/";
$userbars->picture[0]="obrazki/fedora.png";

?>
