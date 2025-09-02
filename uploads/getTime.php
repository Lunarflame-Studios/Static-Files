<?php
    date_default_timezone_set('US/Eastern');
    $currenttime = date("m-d-Y H:i:s l");
    list($ddd, $ttt, $day) = explode(' ', $currenttime);
    echo "$ddd/$ttt/$day";
?>