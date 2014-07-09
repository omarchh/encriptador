<?php
	class Crypter{

		function crypt($string_to_crypt){
			echo $string_to_crypt."\n\r\n\r";
			if($string_to_crypt === ""){
				$crypted = "Text not inserted";
			}else{
				$crypted = "";
				$array = [];
				for($i=0;$i<strlen($string_to_crypt);$i++){
					$array[$i]=$string_to_crypt[$i]; 
				}
				$lengthArray = (count($array)-1);
				foreach($array as $pos){
					$crypted = $crypted . (rand(0,11).'|11m'.$pos.'|'.rand(0,1991).'|%91'.$pos.rand(0,13).'|@13xx'.$pos.'.|+');
				}
			}
			return $crypted;
		}
	}	
?>