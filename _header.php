<?php
require_once "_tools.php";
include_once "analyticstracking.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta charset="utf-8">
        <title>Mediathèque BD</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="css/styles.css" rel="stylesheet">     
        <style>
            body { 
                padding-top: 50px; 
                /*A padding at bottom to let last images zoom properly*/
                padding-bottom: 300px; 
                
            }
            /*A class to put on image that is the zoomed version of the sibling zoomable*/
            .zoomed{
            	position: absolute;
            	width:0px;
            	-webkit-transition:width 0.2s linear 0s;
            	transition:width 0.2s linear 0s;
            	z-index:10;
            }
            /*A class to put on image that can be zoomed*/
            .zoomable:hover + .zoomed{
            	width:300px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <a href="/index.php" class="navbar-brand">MEDIATHEQUE BD</a>
                </div>
                <nav class="collapse navbar-collapse" role="navigation">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="http://ce.palays.free.fr/BD/Web/index.php">L'ancien site</a>
                        </li>
                        <li>
                            <a href="date.php">Par date</a>
                        </li>
                        <li>
                            <a href="contact.php"><span class="glyphicon glyphicon-envelope"></span>  contact</a>
                        </li>
                        <form class="navbar-form navbar-left" role="search" method="get" action="search.php">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Album/Auteur/Serie" name="s">
                            </div>
                            <button type="submit" class="btn btn-default">Chercher</button>
                        </form>
                    </ul>
                </nav>
                
            </div>
        </nav>

        <!--main-->
        <div class="container">