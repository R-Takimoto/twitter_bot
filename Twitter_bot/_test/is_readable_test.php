<?php

$path_1 = '/var/www/sf_win/git_twitter/Twitter_bot/images/sun_giragira.png';
$path_2 = '/git_twitter/Twitter_bot/images/sun_giragira.png';
$path_3 = '../images/sun_giragira.png';
$path_4 = __DIR__;



if(is_readable($path_3)) {
    echo '可能';
}else {
    echo '不可';
}

echo $path_4;

?>