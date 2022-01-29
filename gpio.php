<?php
// begin param
$gpiopath = "/sys/kernel/vgpio"; // https://github.com/nikarana/vgpio For a Raspberry Pi the value is "/sys/class/gpio"
// end param
if (!file_exists($gpiopath."/gpio".$_GET["n"]."/direction"))
{
$efs = fopen($gpiopath."/export","w");
fwrite($efs,$_GET["n"]);
fclose($efs);
}
$dirfs = fopen($gpiopath."/gpio".$_GET["n"]."/direction","w");
if ($_GET["m"] == "in")
{
fwrite($dirfs,"in");
fclose($dirfs);
$vfs = fopen($gpiopath."/gpio".$_GET["n"]."/value","r");
$v = fread($vfs,1);
echo $v;
fclose($vfs);
}
if ($_GET["m"] == "out")
{
fwrite($dirfs,"out");
fclose($dirfs);
$vfs = fopen($gpiopath."/gpio".$_GET["n"]."/value","w");
fwrite($vfs,$_GET["v"]);
fclose($vfs);
}
