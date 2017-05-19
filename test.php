<?
 $date = '2017-05-19 16:22:07';
 echo $date.'<br>';
 $week = "+1week";
 $deb = date('Y-m-d G:i:s',strtotime($date.$week));
 echo $deb;
?>