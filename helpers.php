<?php

require "vendor/autoload.php";

use duncan3dc\Laravel\BladeInstance;

$path_data = "/datas/";

function home_url() {
	if (php_sapi_name() == "cli") {
    	return '';
	}

	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

	$url = $protocol . $_SERVER['HTTP_HOST'] . str_replace('/index.php', '', Flight::request()->base);

	return rtrim($url, '/') . '/';
}

function site_name() {
	return isset($_SERVER['SERVER_NAME']) ? ucwords(explode('.', $_SERVER['SERVER_NAME'])[0]) : $_SERVER['argv'][1];
}

function view($template, $data = [], $echo = true) {
	$blade = new BladeInstance(__DIR__ . '/views', __DIR__ . '/cache');
	$blade->addPath(__DIR__ . '/ads');

	if(!$echo){
		return $blade->render($template, $data);
	}

	echo $blade->render($template, $data);
}

function hashtags() {
	global $path_data;

	$path = __DIR__ . $path_data;
	$hashtags = glob($path . "*.srz.php");
	$hashtags = str_replace([$path, '.srz.php'], '', $hashtags);

	$hashtags = str_replace('-', ' ', $hashtags);

	return $hashtags;
}

function get_filename($hashtag) {
	global $path_data;

	return __DIR__ . $path_data . $hashtag . '.srz.php';
}

function get_data($slug) {
	global $path_data;

	$filename = __DIR__ . $path_data . $slug . '.srz.php';
	$data = @unserialize(@file_get_contents($filename));

	return collect($data)->chunk(13)->toArray();
}

function pages() {
	return [
		'dmca',
		'contact',
		'privacy-policy',
		'copyright',
	];
}

function hashtag_url($hashtag, $img = false) {
	return home_url() . $hashtag . '.html';
}

function scrape_hashtag($hashtag, $limit = 20) {
	$instagram = new \InstagramScraper\Instagram();
	$medias = $instagram->getMediasByTag($hashtag, $limit);

	$datas = [];
	foreach ($medias as $key => $media) {
		$datas[$key]['id'] = $media->getId();
		$datas[$key]['short_code'] = $media->getShortCode();
		$datas[$key]['created_time'] = $media->getCreatedTime();
		$datas[$key]['caption'] = $media->getCaption();
		$datas[$key]['comments_count'] = $media->getCommentsCount();
		$datas[$key]['likes_count'] = $media->getLikesCount();
		$datas[$key]['link'] = $media->getLink();
		$datas[$key]['image'] = $media->getImageHighResolutionUrl();
		$datas[$key]['type'] = $media->getType();
		$account = $media->getOwner();
		$datas[$key]['owner_id'] = $account->getId();
		$datas[$key]['owner_username'] = $account->getUsername();
		$datas[$key]['owner_fullname'] = $account->getFullName();
		$datas[$key]['owner_pic'] = $account->getProfilePicUrl();
	}

	return $datas;
}

function clear_data() {
	foreach (glob('datas/*.php') as $file) {
		unlink($file);
	}
}