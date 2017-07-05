<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sayings of the Messenger P.B.U.H</title>
     <link rel="stylesheet" href="https://bootswatch.com/slate/bootstrap.min.css">
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
       <li  ><a href="<?php echo site_url('hadith') ?>">Hadith</a></li>
       <li ><a href="<?php echo site_url('twitter') ?>">Twitter</a></li>
       <li class="active"><a href="<?php echo site_url('telegram') ?>">Telegram</a></li>
      </ul>
     
     
    </div>
  </div>
</nav>
     
          
</head>
<body>


    <div class="container">
        <?php echo form_open_multipart('telegram/send', ['class'=>'form-horizontal']) ?>
        <?= form_hidden('created_at', date('Y-m-d H:i:s')) ?>
    <fieldset>
        <legend>Telegram</legend>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                <label for="inputEmail" class="col-lg-4 control-label">Write Text</label>
            <div class="col-lg-8">
                <?php echo form_textarea(['name'=>'body','class'=>'form-control','placeholder'=>'Text',
                'value'=> set_value('body')]) ?>
            </div>
                </div>
            </div>

            <div class="col-lg-6">
                <?php echo form_error('body'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
            <label for="inputEmail" class="col-lg-4 control-label">Select Image</label>
            <div class="col-lg-8">
                <?php echo form_upload(['name'=>'image','class'=>'form-control']); ?>
            </div>
            </div>
        </div>
        <div class="col-lg-6">
            <?php if(isset($upload_error)) echo $upload_error ?>
        </div>
        </div>


        <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">

            <?php 
                echo form_reset(['name'=>'reset','value'=>'Reset','class'=>'btn btn-default']),
                    form_submit(['name'=>'submit','value'=>'Submit','class'=>'btn btn-primary']);
            ?>
        </div>
        </div>
    </fieldset>
    </form>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
</body>
</html>