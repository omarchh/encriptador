<?php
	class Encrypter{

		public static function crypt($cadena){
			$crypted = "";
			$array = [];

			for($i=0;$i<strlen($cadena);$i++){
				$array[$i]=$cadena[$i]; 
			}

			$lengthArray = (count($array)-1);

			foreach($array as $pos){
				$crypted = $crypted . (rand(0,11).'|11m'.$pos.'|'.rand(0,1991).'|%91'.$pos.rand(0,13).'|@13xx'.$pos.'.|+');
			}

			return $crypted;
		}
	}	
?>
