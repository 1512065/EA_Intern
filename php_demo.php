<?php
   function TinhTong($a,$b)
   {
	   $Tong = $a + $b;
	   return $Tong;
   }
   $kq = TinhTong(5,3);
   print "Ket qua: $kq <br>";
   $c=10;
   $kq2 =TinhTong($c,5);
   print "Ket qua: $kq2 <br />";
  
   #Demo MANG
   $mang1 = array(1,2,3,4);
   print "$mang1[0]";
	$mang2= array("Toan"=>6, "Van"=>7);
	print $mang2['Toan'];
   
   #Demo CHUOI
   $chuoi1 = "Hello";
   $chuoi2 = "World";
   #Nối = dấu .
   echo $chuoi1.$chuoi2;
   echo strlen($chuoi1);
   
   ##demo if
   print "<br>";
   if ($chuoi1=="Hello")
	   print'OK';
   else 
	   print 'aaa';
   
   if ($c>3)
	   print'OK';
   
?>