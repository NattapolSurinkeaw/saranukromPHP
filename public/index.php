<?php
require_once "../app/core/App.php";
require_once "../app/controllers/PageController.php";

// กำหนด Route
$routes = [
    // Page route
    '/' => ['PageController', 'home'],
    '/manga' => ['PageController', 'getManga'],
    '/doujin' => ['PageController', 'getDoujin'],
    '/episode/{id}' => ['PageController', 'getEpisodeManga'],
    '/read/{id}' => ['PageController', 'getReadManga'],
    '/search' => ['PageController', 'searchPage'],
    '/aboutus' => ['PageController', 'about'],

    '/testt' => ['HomeController', 'testt'],
    '/testpost' => ['HomeController', 'testPost'],
        
    '/tagPage' => ['BackendController', 'tagPage'],
    '/authorPage' => ['BackendController', 'authorPage'],

    '/backend/login' => ['AuthenController', 'loginPage'],
    '/backend/dashboard' => ['BackendController', 'dashboardPage'],
    '/backend/manageEpisode/{id}' => ['BackendController', 'manageEpisode'],
    '/backend/manageImage/{id}' => ['BackendController', 'manageImage'],
    
    // Function routes
    '/authentication' => ['AuthenController', 'Authentication'],
    '/logout' => ['AuthenController', 'getLogOut'],
    
    '/createManga' => ['BackendController', 'createManga'],
    '/deleteManga/{id}' => ['BackendController', 'deleteManga'],
    
    '/createTag' => ['BackendController', 'createTag'],
    '/createAuthor' => ['BackendController', 'createAuthor'],

    '/createEpisode/{id}' => ['BackendController', 'createNewEpisode'],
    '/deleteEpisode/{id}/{manga_id}' => ['BackendController', 'deleteEpisode'],

    '/addNewImage/{id}' => ['BackendController', 'addNewImage'],
];

// สร้าง App และส่ง routes เข้าไป
$app = new App($routes);