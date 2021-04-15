<?php

if(isset($_FILES['file']['name'])){
   echo $_FILES['file']['name'];
   exit;
}

echo 0;

