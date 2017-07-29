<?php
	$cmd = "nmap -sL "."192.168.1.1/24";
	$s = "";
	exec($cmd." 2>&1", $output, $status);
	for ($i=0; array_key_exists($i, $output); $i++) { 
        if (strpos($output[$i],"Nmap scan report for") !== false) {
        	if (strpos($output[$i], "(") !== false) {
        		$IP = substr($output[$i], strrpos($output[$i], "(")+1, strlen($output[$i])-strrpos($output[$i], "(")-2);
        		$info = substr($output[$i], 21, strrpos($output[$i], "(")-22);
        		$s .= $IP.", ".$info.",";
        	}
        }
    }
    echo substr($s, 0, -1);
?>