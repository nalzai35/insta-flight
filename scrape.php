<?php
if(PHP_SAPI !== 'cli'){ die; }

require "vendor/autoload.php";
require "helpers.php";
require "google-drive.php";

$file = $argv[1];

$hashtags = explode("\n", file_get_contents($file));
$hashtags = array_map('trim', $hashtags);
$hashtags = array_values(array_filter($hashtags));

echo "\n
=================================
Start importing ". $argv[1] . " - " .count($hashtags). "
=================================\n\n";

$count = 1;

do {
    try {
        $hashtag = array_shift($hashtags);
        $hashtag = trim($hashtag, '#');

        echo '==> scraping #' . $count . ': ' . $hashtag . "...\n";

        $datas = scrape_hashtag($hashtag, 100);
        $file_path = get_filename($hashtag);
        $file_name = $hashtag . '.srz.php';

        file_put_contents($file_path, serialize($datas));

        // $folder_id = create_folder( "Data Scrape Hashtag Instagram" );
        $folder_id = '1YIsdAg5gnPhJ00CpFeXS4pkBKfCd8HgT';
        insert_file_to_drive( $file_path , $file_name, $folder_id);
        clear_data();
    } catch (\Exception $e) {
        echo '===>' . $e->getMessage() . "\n";
		sleep(rand(5, 60));
    }

    sleep(1);
    $count++;

} while (! empty($hashtags) );
