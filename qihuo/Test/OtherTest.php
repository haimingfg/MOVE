<?php

while(NULL) {
	echo 'NULL<br/>';
	break;
}

while(array()) {
	echo 'array<br/>';
	break;
}

while(false) {
	echo 'FALSE<br/>';
	break;
}

while('') {
	echo '\'\'<br/>';
	break;
}

while(array(1)) {
	echo 'array(1)<br/>';
	break;
}

class a {
	public $a = 1;
	public $b = 2;
	private $c = 3;
	protected $d = 4;
	function b() {
		echo 1;	
	}
}
$a = new a();
echo '<pre>';
var_dump($a);
foreach ($a as $key => $val) {
	var_dump($key, $val);
}
