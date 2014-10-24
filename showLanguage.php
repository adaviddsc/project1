<?php
include("Language.php");
$lang = new Language();
 
$lang->load("english");
echo $lang->line("index") . "\n";

?>