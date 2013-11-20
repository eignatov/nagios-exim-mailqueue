#!/usr/bin/php5
<?php
$number_mails=chop(shell_exec("/usr/bin/sudo /usr/sbin/exim -bpc"));
switch ($number_mails) {
        case $number_mails < 200:
        echo "OK - $number_mails correos en la cola de salida.";
        exit(0);
        case $number_mails > 200 && $number_mails < 300  :
        echo "WARNING - $number_mails correos en la cola de salida.";
        exit(1);
        case $number_mails > 300:
        echo "CRITICAL - $number_mails correos en la cola de salida.";
        exit(2);
        default:
        echo "UNKNOWN - $number_mails correos en la cola de salida.";
        exit(3);
}
?>