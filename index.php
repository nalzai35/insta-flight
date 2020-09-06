<?php
require 'vendor/autoload.php';
require 'helpers.php';

Flight::route('/', function(){
    view('home');
});

Flight::route('/pages/@page.html', function($page){
    view('pages.page', ['page' => $page]);
});

Flight::route('/@tag.html', function($tag) {
    view('hashtag', ['tag' => $tag]);
});

Flight::start();