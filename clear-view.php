<?php
// prevent browser
if(PHP_SAPI !== 'cli'){ die; }

foreach (glob('cache/*.php') as $file) {
	unlink($file);
}

echo "Views cache cleared\n";