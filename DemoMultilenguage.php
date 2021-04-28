<?php

ini_set('display_errors', true);
error_reporting(E_ERROR | E_PARSE | E_NOTICE | E_WARNING);

$base='ontime/';
$AdminPassword='OT2021Free';
include_once($base."OnTime.php");
$demo=new OnTime();
echo "**********+++++++++++ <br> Basic Table Demo <br> **********+++++++++++ <br> <br>";
echo "********** <br> Create Class  <br> ********** <br> <br>";
$demo->ot_error('basic content exist').'<br>';
echo "**********+++++++++++ <br> Conecting like admin <br> **********+++++++++++ <br> <br>";
echo "Connect('admin','OT2021Free') ";
$demo->Connect('admin',$AdminPassword);
echo  "<br>";$demo->ot_error("Connected!!!");echo "<br>";


echo "********** <br> Defining Data dictyonary for General Porpuse <br> ********** <br> <br>";

$demo->DddAddFld('RecId', array('FldTpe'=>'K','FldDsc'=>'Record Identifier'));
$demo->DddAddFld('RecId', array('FldTpe'=>'K','FldDsc'=>'Record Identifier'));
$demo->DddAddFld('Name', array('FldTpe'=>'S','FldDsc'=>'Store the name'));
$demo->DddAddFld('Name', array('FldTpe'=>'S','FldDsc'=>'Store the name'));
$demo->DddAddFld('File', array('FldTpe'=>'P','FldDsc'=>'Name of the free text'));
$demo->DddAddFld('File', array('FldTpe'=>'P','FldDsc'=>'Name of the free text'));
$demo->DddAddFld('Img', array('FldTpe'=>'l','FldDsc'=>'Name of the image'));
$demo->DddAddFld('Img', array('FldTpe'=>'l','FldDsc'=>'Name of the image'));

echo "********** <br> Defining Lenguages in main<br> ********** <br> <br>";

echo "********** <br> Defining Lenguages  <br> ********** <br> <br>";
$name = 'Lenguages';
$name = 'Lenguages';
$demo->CrtRcd($name,'Lenguages');
$demo->CrtRcd($name,'Lenguages');
$demo->RcdAddIn($name,'RecId', array('FldEmp'=>FALSE));
$demo->RcdAddIn($name,'RecId', array('FldEmp'=>FALSE));
$demo->RcdAddIn($name,'Name', array('FldEmp'=>FALSE));
$demo->RcdAddIn($name,'Name', array('FldEmp'=>FALSE));
$demo->RcdAddIn($name,'Img', array('FldEmp'=>TRUE));
$demo->RcdAddIn($name,'Img', array('FldEmp'=>TRUE));

echo "********** <br> Activating tables in main & cresating lenguage<br> ********** <br> <br>";

echo "CrtFtrTbl('main')";
$demo->CrtFtrTbl('main');
echo "CrtTblIn('Lenguages', 'Lenguages avaible on sisitem', 'Lenguages' , 'main')";
$demo->CrtTblIn('Lenguages', 'Lenguages avaible on sisitem', 'Lenguages' , 'main');

echo "********** <br> Inserting English like lenguage  <br> ********** <br> <br>";
echo "InsTblIn('Lenguages' , 'En', array('Name'=>'English', 'Img'=> 'usa flag'),'main')";
$demo->InsTblIn('Lenguages' , 'En', array('Name'=>'English', 'Img'=> 'usa flag'),'main');
echo "********** <br> Inserting Spanish like lenguage  <br> ********** <br> <br>";
echo "InsTblIn('Lenguages' , 'Es', array('Name'=>'Español', 'Img'=> 'bandera española'),'main')";
$demo->InsTblIn('Lenguages' , 'Es', array('Name'=>'Español', 'Img'=> 'bandera española'),'main');
echo "********** <br> Inserting Spanish mexico like lenguage  <br> ********** <br> <br>";
echo "InsTblIn('Lenguages' , 'Mx', array('Name'=>'Español (México)', 'Img'=> 'bandera mexicana'),'main')";
$demo->InsTblIn('Lenguages' , 'Mx', array('Name'=>'Español (México)', 'Img'=> 'bandera mexicana'),'main');

echo "********** <br> Set english to default lenguage <br> ********** <br> <br>";
echo "LngDflSys('En')";
$demo->LngDflSys('En');

echo "********** <br> Set read mode like full (if something is not en the leguage read default) <br> ********** <br> <br>";
echo "LngFllSys('yes')";
$demo->LngFllSys('yes');

echo "********** <br> Set read mode like full (if something is not en the leguage read default) <br> ********** <br> <br>";
echo "LngRad('Es')";
$demo->LngRad('Es');
echo "********** <br> Set read mode like full (if something is not en the leguage read default) <br> ********** <br> <br>";
echo "LngRadMsr('Es')";
$demo->LngRadMsr('Es');
echo "********** <br> Set read mode like full (if something is not en the leguage read default) <br> ********** <br> <br>";
echo "LngWrtMsr('Es')";
$demo->LngWrtMsr('Es');
echo "********** <br> Set read mode like full (if something is not en the leguage read default) <br> ********** <br> <br>";
echo "LngWrtSys('Es')";
$demo->LngWrtSys('Es');
echo "********** <br> Set read mode like full (if something is not en the leguage read default) <br> ********** <br> <br>";
echo "LngRadUsr('Es','Admin')";
$demo->LngRadUsr('Es','Admin');
echo "********** <br> Set read mode like full (if something is not en the leguage read default) <br> ********** <br> <br>";
echo "LngWrtUsr('Es','Admin')";
$demo->LngWrtUsr('Es','Admin');


echo "**********+++++++++++ <br> Demo Finish<br> **********+++++++++++ <br> <br>";
?>