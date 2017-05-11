<!DOCTYPE html>

<?php    
    require_once("../resources/config.php");
?>
 
<html lang="en">
  <head>
    <title>DAGR Saver</title>
    <meta content="text/html; charset=utf-8"/>
    <meta id="meta-description" name="description" content="A Multimedia Data Aggregator"/>
    <!-- jQuery import -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- bootstrap styling below -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- personal styling and js below -->
    <script src="/js/header.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
  </head>
 
  <body>
    <div class='container header'>
      <h1><a href="#" onClick='changePage("main")'>DAGR Saver</a></h1>
      <ul class='list-inline'>
        <li><div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Add
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#" onClick='changePage("adddagr")'>Add DAGR</a></li> <!-- TODO see which page change is better! -->
            <li><a href="#" onClick='changePage("addfile")'>Add File (with DAGR)</a></li>
            <li><a href="#" onClick='changePage("addcat")'>Add DAGR Category</a></li>
          </ul>
        </div></li>
        <li><div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">View All
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#" onClick='changePage("viewdagr")'>View All DAGRs</a></li>
            <li><a href="#" onClick='changePage("viewfile")'>View All Files</a></li>
            <li><a href="#" onClick='changePage("filecontains")'>View All File Relationships</a></li>
          </ul>
        </div></li>
        <li><div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Search/Modify/Delete
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#" onClick='changePage("searchdagr")'>Search/Modify/Delete DAGRs</a></li>
            <li><a href="#" onClick='changePage("searchfile")'>Search/Modify/Delete Files</a></li>
          </ul>
        </div></li>
        <li><div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Database Reports
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="#" onClick='changePage("orphansterile")'>Orphan/Sterile DAGRs</a></li>
            <li><a href="#" onClick='changePage("reachdagr")'>DAGR Reach Query</a></li>
            <li><a href="#" onClick='changePage("timerange")'>Time-Range Report</a></li>
          </ul>
        </div></li>
      </ul>
    </div>
    <div class='container main-content' id='main-content'>
    