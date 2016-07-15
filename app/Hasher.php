<?php

namespace App;
/**
* Hasher
*/
class Hasher
{
	
	

	public function create_hash($password) {
	    // $output = "";
	    $com = 'php genhash.php '.$password;
	    exec($com, $output);
	    return $output[0];
	}
}