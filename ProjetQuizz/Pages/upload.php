<?php
require("../Includes/functions.php");

if(!empty($_FILES['MEDIA']['name']))
{
    $message=AddMedia('MEDIA');
    if($message!="Ok")
    { ?>
        <div class="alert alert-danger" role="alert">
            <img src="../Icons/svg/warning.svg" alt="warning">
            <?=$message?>
        </div>
    <?php
    }
}

if(empty($_FILES['MEDIA']['name']) or $message=="Ok")
{
    $media=$_FILES['MEDIA']['name'];
    print($media);
}
?>