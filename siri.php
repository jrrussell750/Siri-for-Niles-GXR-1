<?php

session_start();

$server_ip = '10.100.0.1'; 
$server_port = 6001; 
$zone = $_GET['zone'];
$InputSelector = $_GET['device'];
print ("input = " . $InputSelector . "<br>" . "Zone = " . $zone . "<br>");

if ($zone == '1') 
{ 
  $zoneid = "\x21";
}
elseif ($zone == '2')
{
  $zoneid = "\x22";
}
elseif ($zone == '3')
{
  $zoneid = "\x23"; 
}
elseif ($zone == '4')
{
  $zoneid = "\x24"; 
}
elseif ($zone == '5')
{
  $zoneid = "\x25"; 
}
elseif ($zone == '6')
{
  $zoneid = "\x26"; 
}
else 
{
print "No Zone Match <br>";
}

if ($InputSelector == '1') 
{
  $inputid = "\x01";
}
elseif ($InputSelector == '2')
{
  $inputid = "\x02";
}
elseif ($InputSelector == '3')
{
  $inputid = "\x03"; 
}
elseif ($InputSelector == '4')
{
  $inputid = "\x04"; 
}
elseif ($InputSelector == '5')
{
  $inputid = "\x05"; 
}
elseif ($InputSelector == '6')
{
  $inputid = "\x06"; 
}
elseif ($InputSelector == '7')
{
  $inputid = "\x0c";    // Volume Up
}
elseif ($InputSelector == '8')
{
  $inputid = "\x0d";    // Volume Down
}
elseif ($InputSelector == '9')
{
  $inputid = "\x2b";    // Previous Song
}
elseif ($InputSelector == '10')
{
  $inputid = "\x2c";    // Next Song
}
elseif ($InputSelector == '11')
{
  $inputid = "\x0a";    //  Zone Off
}
else {
print "No Input Match <br>";
}

$message = "\x00\x12\x00" . $zoneid . "\x00\x0b\x61\x06" . $inputid . "\x00\xff";
//            \x00\x0e\x00     \x23       \x00\x0b\x61\x06     \x03     \x00\xff


if ($socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)) {
    socket_bind($socket, $_SESSION["LocalIP"], 6001);
    socket_sendto($socket, $message, strlen($message), 0, $server_ip, $server_port);
}
else {
  print("can't create socket\n");
}

if ($InputSelector == 'Vol*'){
    for ($x=1; $x<=5; $x++){
         socket_sendto($socket, $message, strlen($message), 0, $server_ip, $server_port);
    }
}

?>
