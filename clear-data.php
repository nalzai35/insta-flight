<?php
// prevent browser
if(PHP_SAPI !== 'cli'){ die; }

foreach (glob('datas/*.php') as $file) {
	unlink($file);
}

echo "Data cleared\n";