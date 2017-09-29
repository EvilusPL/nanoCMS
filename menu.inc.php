<?php

// Define menu here

class Menu
{
	public $link = array(); 	// array with links
	public $name = array(); 	// array with names
	public $mnu_elements = 1; 	// how many elements menu must contain
}

$menu = new Menu();

$menu->link[0]="index.php?id=index&mnu=0";
$menu->name[0]="Main page";


?>
