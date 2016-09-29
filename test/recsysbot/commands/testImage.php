<?php 

$external_link = './../images/poster.jpg';
if (@getimagesize($external_link)) {
echo  "image exists";
} else {
echo  "image does not exist";
}


 ?>