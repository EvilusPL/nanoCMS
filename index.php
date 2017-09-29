<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Language" content="pl">
		<link rel="Stylesheet" href="style.css">
		<?php
		// include required files to get nanoCMS working properly
		require("header.inc.php"); // header settings
		require("title.inc.php"); // title settings
		require("menu.inc.php"); // menu settings
		require("userbars.inc.php"); // userbars settings
		require("footer.inc.php"); // footer settings
		
		// if mnu get is null or equals zero use the id to write title of the subpage
		// otherwise, use name of the link from menu.inc.php
		if (intval($_GET['mnu'])==0) {
			print("<title>".$title." - ".$_GET['id']."</title>");
		}
		else {
			print("<title>".$title." - ".$menu->name[intval($_GET['mnu'])]."</title>");
		}
		?>
	</head>
	<body>
		<div id="header">
            <?php
			print("<div id=\"logo\">".$logo."</div>");
			print("<div id=\"slogan\">".$slogan."</div>");
            ?>
		</div>
		<div id="menu">
			<?php
			// let's write the menu in horizontal view
			for ($i = 0; $i < $menu->mnu_elements; $i++)
			{
				print "<a href=\"".$menu->link[$i]."\">".$menu->name[$i]."</a> ";
			}
			?>
		</div>
		<div id="content">
			<div id="left_menu">
				<ul>
					<?php
					// write menu in vertical view, in pointed list
					for ($i = 0; $i < $menu->mnu_elements; $i++)		
					{
						print "<li><a href=\"".$menu->link[$i]."\">".$menu->name[$i]."</a></li>";
					}
					?>
				</ul>
			</div>
			<div id="right_content">
				<?php
				// the main code that is under our interest - generating the page content!
				if ($_GET['id']=="") {						// if page ID equals null
					if (file_exists("contents/index.html")) {		// check if index.html exists
					$page = fopen("contents/index.html", "r");		// if yes, open the file in read-only mode
					while($line = @fgets($page, 1024))  {			// write contents to our page
						print($line);
					}
					fclose($page);						// and close file
					}
					else {							// if not exists, throw the error
						print("<h1>Error!</h1><br>");
						print("There is no configured main page, it should be in <b>contents/index.html</b>");
					}
				}
				else {								// if page ID equals any other value
					if(file_exists("contents/".$_GET['id'].".html"))  {	// do the same thing like code above
					$page = fopen("contents/".$_GET['id'].".html", "r");	// but with parameter to read and print custom file
					while($line = @fgets($page, 1024)) {
						print($line);
					}
						fclose($page);
					}
					else {
						print("<h1>Error 404!</h1><br>");
						print("There is no such page! Maybe there is dead link? Contact with webmaster");
					}
				}
                ?>
			</div>
		</div>
		<div id="userbars">
                <?php
                // print userbars defined in userbars.inc.php
                print("<br><br>");
                for ($i = 0; $i < $userbars->userbars_elements; $i++) {
                    print("<a href=\"".$userbars->link[$i]."\" target=\"blank\"><img src=\"".$userbars->picture[$i]."\"></a>");
                }
                print("<br><br>");
                ?>
		</div>
		<div id="footer">
		<?php
		// print footer, with data from footer.inc.php
                print("&copy; ".$creationYear."-".date("Y")." ".$author.". ".$license."<br>");
                print("<br>Powered by nanoCMS, &copy; 2016-2017 Jarosław Rauza. Released under GNU GPL license");
                ?>
		</div>
	</body>
</html>
