<?php
/**
 * Created by PhpStorm.
 * User: ahmad
 * Date: 03-05-19
 * Time: 09:07
 */
echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="ClassNotFound">
            <meta name="author" content="Amaury de Tremerie and Sharifrazi Mir">
            <link rel="stylesheet" type="text/css" href="'.VIEWS_WAY.'css/bootstrap.css">
            <title>ClassNotFound: Where you find All your Answer</title>
         </head>
         <body>
         <div class="container-fluid">
         <header class="row">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php"><img class="img-fluid float-left rounded"  src="'.VIEWS_WAY.'images/logo.png" alt="logo">Where you can find all your answers !</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <form method="GET" class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" value="" name="search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form>';
          echo'<ul class="navbar-nav mr-auto">
                 <li class="nav-item active"><a class="nav-link" href="index.php">Recent Questions <span class="sr-only">(current)</span></a></li>';
                 if(empty($session)) {
                  echo '
                  <li class="nav-item"><a class="nav-link" href="index.php?action=login">Login</a></li>
                  <li class="nav-item"><a class="nav-link" href="index.php?action=signup">Sign-Up</a></li>';
                 }
                 else {
                  echo '
                     <li class="nav-item"><a class="nav-link" href="index.php?action=ask">Ask a Question</a></li>
                     <li class="nav-item"><a class="nav-link" href="index.php?action=profile">My Questions</a></li>';
                  if ($session->getAdmin() == 1) {
                     echo '<li class="nav-item"><a class="nav-link" href="index.php?action=panel">Admin Panel</a></li>';
                  }
                 echo'<li class="nav-item"><a class="nav-link" href="index.php?action=logout">Logout</a></li>';
                 }
           echo'
               </ul>
            </div>
         </nav>
      </header> 
      <div class="row">
          ';