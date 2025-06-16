<?php
    if(!empty($_POST['col'])){
        $url  = 'painter.php?col=' . urlencode($_POST['col']);
        header("location: $url");
        exit();
    }
?>