<?php

class Blog
{
    public $entry = array();
    public $name = array();
    public $author = array();
    public $date = array();
    public $disqus_domain_name = "mydisqus";
    public $blog_entries = 1;
    public $blog_entries_per_page = 5;
}

$blog = new Blog();

$blog->entry[0]="first";
$blog->name[0]="First entry on my blog";
$blog->author[0]="webmaster";
$blog->date[0]="30.09.2017";

?>
