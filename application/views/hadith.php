<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sayings of the Messenger P.B.U.H</title>
     <<link rel="stylesheet" href="https://bootswatch.com/slate/bootstrap.min.css">
       <?= link_tag('assets/css/ahadith.css') ?>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

      <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Sayings Of the Messenger P.B.U.H</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="<?php echo site_url('subscribe') ?>">Subscribe</a></li>
        <li><a href="<?php echo site_url('message') ?>">Message</a></li>
       <li  class="active"><a href="<?php echo site_url('hadith') ?>">Hadith</a></li>
       <li ><a href="<?php echo site_url('twitter') ?>">Twitter</a></li>
       <li ><a href="<?php echo site_url('telegram') ?>">Telegram</a></li>
      </ul>
     
     
    </div>
  </div>
</nav>
     
          
</head>
    <body>
        <div class="container">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                    <th>#ID</th>
                    <th>Message ID</th>
                    <th>Message Status</th>
                    <th>Created At</th>
                    <th>Meesage</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php foreach($ahadith as $hadith):?>
                        <tr class="active">
                            <td><?php echo $hadith['id']; ?><td>
                            <td><?php echo $hadith['message_id']; ?><td>
                            <td><?php echo $hadith['message_status']; ?> <td>
                            <td><?php echo $hadith['created_at'];  ?><td>
                            <td><?php echo $hadith['message'];  ?><td>
                        </tr>    
                        <?php endforeach; ?>
                    
                </tbody>
            </table> 
                            
            
        </div>
    </body>
</html>