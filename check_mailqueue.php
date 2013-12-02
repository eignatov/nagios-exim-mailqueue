#!/usr/bin/php5
<?php
$number_mails=chop(shell_exec("/usr/bin/sudo /usr/sbin/exim -bpc"));
$correosxdominios = chop(shell_exec('/usr/bin/sudo /usr/sbin/exim -bpr | grep "<" | awk {'."'print $4'".'} |cut -d "<" -f 2 | cut -d ">" -f 1 | sort -n | uniq -c| sort -n'));
$drives = preg_split("[\r|\n]", trim($correosxdominios));
array_shift($drives);
$salida='';
foreach ($drives as $key => $line){
        $line = trim(preg_replace('/\s+/',' ', $line));
        $linearray = explode(' ',$line);
        foreach($linearray as $keyl => $linea){
                if($keyl == 0){
                        $salida.="($linea)";
                }
                if ($keyl ==1){
                        $salida.=$linea." ";
                }
        }
}

$correosxdominios=$salida;
switch ($number_mails) {
        case 0:
         echo "OK - $number_mails correos en la cola de salida.";
         exit(0);
        case $number_mails < 200:
        echo "OK - $number_mails correos en la cola de salida.";
        exit(0);
        case $number_mails > 200 && $number_mails < 300  :
        echo "WARNING - $number_mails correos en la cola de salida.".$correosxdominios;
        exit(1);
        case $number_mails > 300:
        echo "CRITICAL - $number_mails correos en la cola de salida.".$correosxdominios;
        exit(2);
        default:
        echo "UNKNOWN - $number_mails correos en la cola de salida.".$correosxdominios;
        exit(3);
}
?>