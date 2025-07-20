<?php
$curl = curl_init();
$dd = curl_setopt_array($curl, array(CURLOPT_URL => 'https://smssmartegypt.com/sms/api/?username=diar11&password=@1U:[N8d?P6X&sendername=?&mobiles=201221563252',CURLOPT_RETURNTRANSFER => true));
echo $dd ;

?>