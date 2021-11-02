<?php 

						//function to print second label
						$filename = "lbliloq_prt.txt";
						$file = fopen($filename, "r+")or die("ERROR: Cannot open the file .")  ;
						if($file){
							fwrite($file, $lblbox2);      
							fclose($file);
						} 

						//print second label
						copy($filename, "//BTS-iLOQ-1/iloqpizza"); 

?>