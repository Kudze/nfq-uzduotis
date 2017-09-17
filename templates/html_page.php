<?php Page::_loadPreprocessor('root'); ?>

<!DOCTYPE html>

<html lang="lt">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="design/css/bootstrap.min.css">
    <link rel="stylesheet" href="design/css/font-awesome.min.css">
    <link rel="stylesheet" href="design/css/design.css">

  </head>

  <body>
    
    <?php

    	Page::_loadTemplate(Page::getPageName() . '_body');

    ?>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="design/js/bootstrap.min.js"></script>
    <script src="design/js/design.js"></script>
  </body>
</html>