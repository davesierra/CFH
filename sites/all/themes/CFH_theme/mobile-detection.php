<?php
/* detect mobile device*/

//For testing purposes set to true to see in Mobile Mode
//Otherwise value should be false
$ismobile = true; 
$container = $_SERVER['HTTP_USER_AGENT'];

// A list of mobile devices 
$useragents = array ( 
  'iPhone', 'Blazer' ,'Palm' ,'Handspring' ,'Nokia' ,'Kyocera','Samsung' ,'Motorola' ,'Smartphone', 'Windows CE' ,'Blackberry' ,'WAP' ,'SonyEricsson','PlayStation Portable', 'LG', 'MMP','OPWV','Symbian','EPOC',
); 

foreach ( $useragents as $useragents ) { 
  if(strstr($container,$useragents)) {
    $ismobile = true;
  } 
}



if ( $ismobile ) {
  echo "<p>Mobile Mode</p>";
  //echo $_SERVER['HTTP_USER_AGENT'];


} else {
  echo "<p>Normal Mode</p>";
  //echo $_SERVER['HTTP_USER_AGENT'];


}

?>