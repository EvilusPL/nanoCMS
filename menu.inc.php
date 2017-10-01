<?php

class Menu
{
	public $link = array();
	public $name = array();
	public $mnu_elements = 2;
}

$menu = new Menu();

$menu->link[0]="index.php?id=index&mnu=0";
$menu->name[0]="Main page";

$menu->link[1]="index.php?id=blog&mnu=1";
$menu->name[1]="Blog";

?>
