<?php

for ($i=1; $i<=68; $i++) {
    $url = 'https://image.slidesharecdn.com/b1goethe-hami-prsentation-161201093521/95/goethezertifikat-b1-prfung-sprechen-themen-beispiele-'.$i.'-1024.jpg?cb=1480585239';
    $file = './myfolder/'.$i.'.jpg';
    $ch = curl_init($url);
    $fp = fopen($file,'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
}
?>