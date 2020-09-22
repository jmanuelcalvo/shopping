<?php
  $app = getenv('OPENSHIFT_BUILD_NAME');
  print "La app: $app Se ejecuta en el host -> " . gethostname() ." (" . $_SERVER['SERVER_ADDR'] . ")"  . "\n";  
?>  
