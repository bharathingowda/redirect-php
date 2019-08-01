<?php
$urls = array('https://www.rappi.com.mx/','https://www.paypal.com.br','https://www.rappi.com.mx/','https://play.google.com/store?hl=en','https://www.superama.com.mx/','https://super.walmart.com.mx/');


$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

foreach($urls as $url) {
    curl_setopt($ch, CURLOPT_URL, $url);
    $out = curl_exec($ch);

   
    $out = str_replace("\r", "", $out);

   
    $headers_end = strpos($out, "\n\n");
    if( $headers_end !== false ) { 
        $out = substr($out, 0, $headers_end);
    }   

    $headers = explode("\n", $out);
    foreach($headers as $header) {
        if( substr($header, 0, 10) == "Location: " ) { 
            $target = substr($header,0);
           

            echo "[$url] redirects to [$target] \n";
            continue 2;
        }   
    }   

    echo "[$url] does not redirect \n";
}

?>
