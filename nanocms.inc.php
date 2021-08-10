<?php

require("title.inc.php");
require("header.inc.php");
require("menu.inc.php");
require("userbars.inc.php");
require("footer.inc.php");

class nanoCMS 
{
    function printTitle()
    {
        $mnu = 0;
		$id = "index";


		if (isset($_GET['mnu'])) {
			$mnu = intval($_GET['mnu']);
		}

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
		}

		if ($mnu == 0 && ($id != 'blog')) {
			print("<title>".$title." - ".$id."</title>");
		}
		else if (($id=='blog')) {
			if (!isset($_GET['entry'])) {
				print("<title>".$title." - Blog</title>");
			}
			else {
				print("<title>".$title." - Blog - ".$blog->name[intval($_GET['entry'])]."</title>");
			}
		}
		else {
			print("<title>".$title." - ".$menu->name[$mnu]."</title>");
		}
    }

    function printHeader()
    {
        print("<div id=\"logo\">".$logo."</div>");
		print("<div id=\"slogan\">".$slogan."</div>");
    }

    function printMenuHorizontal()
    {
        for ($i = 0; $i < count($menu->link); $i++)
        {
            print "<a href=\"".$menu->link[$i]."\">".$menu->name[$i]."</a> ";
        }
    }

    function printMenuVertical()
    {
        print "<ul>";
        for ($i = 0; $i < count($menu->link); $i++)		
        {
            print "<li><a href=\"".$menu->link[$i]."\">".$menu->name[$i]."</a></li>";
        }
        print "</ul>";
    }

    function printContent($filename)
    {
        if(file_exists($filename))  {
            $page = fopen($filename, "r");
            while($line = @fgets($page, 1024)) {
                print($line);
            }
            fclose($page);
        }
        else {
            print("<h1>Error 404!</h1><br>");
            print("There is no such page! Maybe I did some mistake? Contact with me to report missing page.");
        }
    }

    function printUserbars()
    {
        print("<br><br>");
        for ($i = 0; $i < count($userbars->link); $i++) {
            print("<a href=\"".$userbars->link[$i]."\" target=\"blank\"><img src=\"".$userbars->picture[$i]."\"></a>");
        }
        print("<br><br>");
    }

    function printFooter()
    {
        print("&copy; ".$creationYear."-".date("Y")." ".$author.". ".$license."<br>");
        print("<br>Uses <a href=\"https://github.com/EvilusPL/nanoCMS/\">nanoCMS</a>, &copy; 2016-2017 Jarosław Rauza. Released under GNU GPL license");
    }
}