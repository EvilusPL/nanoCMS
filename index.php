<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Language" content="pl">
		<link rel="Stylesheet" href="style.css">
		<?php
		require("header.inc.php");
		require("title.inc.php");
		require("menu.inc.php");
		require("blog.inc.php");
		require("userbars.inc.php");
		require("footer.inc.php");
		if ((intval($_GET['mnu'])==0) && ($_GET['id']!='blog')) {
			print("<title>".$title." - ".$_GET['id']."</title>");
		}
		else if (($_GET['id']=='blog')) {
			if ($_GET['entry']=="") {
				print("<title>".$title." - Blog</title>");
			}
			else {
				print("<title>".$title." - Blog - ".$blog->name[intval($_GET['entry'])]."</title>");
			}
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
					for ($i = 0; $i < $menu->mnu_elements; $i++)		
					{
						print "<li><a href=\"".$menu->link[$i]."\">".$menu->name[$i]."</a></li>";
					}
					?>
				</ul>
			</div>
			<div id="right_content">
				<?php
                    if ($_GET['id']=="") {
                        if (file_exists("contents/index.html")) {
                            $page = fopen("contents/index.html", "r");
                            while($line = @fgets($page, 1024))  {
                                print($line);
                            }
                            fclose($page);
                        }
                        else {
                            print("<h1>Error!</h1><br>");
                            print("File with main page content is missing, it should be existing in <b>contents/index.html</b>");
                        }
					}
					else if ($_GET['id']=='blog') {
						if ($_GET['entry'] == "") {
							if ($blog->blog_entries <= $blog->blog_entries_per_page) {
								for ($i=$blog->blog_entries-1; $i>=0; $i--) {
									print("<h1><a href=\"index.php?id=blog&entry=".$i."\">".$blog->name[$i]."</a></h1>");
									print("<b>Author</b>: ".$blog->author[$i].", <b>date</b>: ".$blog->date[$i]."<br><br>");
									if (file_exists("entries/".$blog->entry[$i].".html")) {
										$entry = fopen("entries/".$blog->entry[$i].".html", "r");
										while ($entry_line = @fgets($entry, 1024)) {
											print($entry_line);
										}
										print("<br><br><a href=\"index.php?id=blog&entry=".$i."#disqus_thread\">Click to comment entry</a><br><hr>");
										fclose($entry);
									}
									else {
										print("<b>Error! Entry not found! Report it to the webmaster!!</b>");
									}
								}
							}
							else {
								if ($_GET['page']=="") {
									$pageID = 1;
								}
								else {
									$pageID = intval($_GET['page']);
								}
								for ($i=$blog->blog_entries-(($pageID-1)*$blog->blog_entries_per_page)-1; ($i>=$blog->blog_entries-(($pageID-1)*$blog->blog_entries_per_page)-$blog->blog_entries_per_page); $i--) {
									if ($i < 0) {
										break;
									}
									print("<h1><a href=\"index.php?id=blog&entry=".$i."\">".$blog->name[$i]."</a></h1>");
									print("<b>Author</b>: ".$blog->author[$i].", <b>date</b>: ".$blog->date[$i]."<br><br>");
									if (file_exists("entries/".$blog->entry[$i].".html")) {
										$entry = fopen("entries/".$blog->entry[$i].".html", "r");
										while ($entry_line = @fgets($entry, 1024)) {
											print($entry_line);
										}
										print("<br><br><a href=\"index.php?id=blog&entry=".$i."#disqus_thread\">Click to comment entry</a><br><hr>");
										fclose($entry);
									}
									else {
										print("<b>Error! Entry not found! Report it to the webmaster!!</b>");
									}
								}
								print("<hr><br>");
								for ($j = 1; $j <= ($blog->blog_entries % $blog->blog_entries_per_page)+1; $j++)
								{
									if ($j == $pageID)
									{
										print(" <b>".$pageID."</b> ");
									}
									else
									{
										print(" <a href=\"index.php?id=blog&page=".$j."\">".$j."</a> ");
									}
								}
							}
						}
						else {
							$entryID=intval($_GET['entry']);
							print("<h1>".$blog->name[$entryID]."</h1>");
							print("<b>Author</b>: ".$blog->author[$entryID].", <b>date</b>: ".$blog->date[$entryID]."<br><br>");
							if (file_exists("entries/".$blog->entry[$entryID].".html")) {
								$entry = fopen("entries/".$blog->entry[$entryID].".html", "r");
								while ($entry_line = @fgets($entry, 1024)) {
									print($entry_line);
								}
								fclose($entry);
							}
							else {
								print("<b>Error! Entry not found! Report it to the webmaster!!</b>");
							}
							?>
							<hr><br><br>
							<div id="disqus_thread"></div>
							<script>

							/**
							*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
							*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
							
							var disqus_config = function () {
							this.page.url = "<?php print($siteURL."index.php?id=blog&entry=".$_GET['entry']); ?>";  // Replace PAGE_URL with your page's canonical URL variable
							this.page.identifier = "<?php print($_GET['entry']); ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
							};
							
							(function() { // DON'T EDIT BELOW THIS LINE
							var d = document, s = d.createElement('script');
							s.src = <?php print("'https://".$blog->disqus_domain_name.".disqus.com/embed.js';");?>
							s.setAttribute('data-timestamp', +new Date());
							(d.head || d.body).appendChild(s);
							})();
							</script>
							<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
							<?php
						}
					}
                    else {
                        if(file_exists("contents/".$_GET['id'].".html"))  {
                            $page = fopen("contents/".$_GET['id'].".html", "r");
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
                ?>
				
			</div>
		</div>
		<div id="userbars">
                <?php
                print("<br><br>");
                for ($i = 0; $i < $userbars->userbars_elements; $i++) {
                    print("<a href=\"".$userbars->link[$i]."\" target=\"blank\"><img src=\"".$userbars->picture[$i]."\"></a>");
                }
                print("<br><br>");
                ?>
		</div>
		<div id="footer">
				<?php
                    print("&copy; ".$creationYear."-".date("Y")." ".$author.". ".$license."<br>");
                    print("<br>Uses <a href=\"https://github.com/EvilusPL/nanoCMS/\">nanoCMS</a>, &copy; 2016-2017 Jarosław Rauza. Released under GNU GPL license");
                ?>
		</div>
	</body>
</html>
