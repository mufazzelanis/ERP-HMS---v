<?php
$folder="models";
foreach (glob("{$folder}/*.class.php") as $filename)
{
    include $filename;
}
?>