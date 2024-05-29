<?php
//here session get end and get destroyed
// After then it will directly 
session_start();
session_unset();
session_destroy();
header("location: /RHT2/");
exit;
