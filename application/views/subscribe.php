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
        <li class="active"><a href="<?php echo site_url('subscribe') ?>">Subscribe</a></li>
        <li ><a href="<?php echo site_url('message') ?>">Message</a></li>
       <li ><a href="<?php echo site_url('hadith') ?>">Hadith</a></li>
       <li ><a href="<?php echo site_url('twitter') ?>">Twitter</a></li>
       <li ><a href="<?php echo site_url('telegram') ?>">Telegram</a></li>
      </ul>
     
     
    </div>
  </div>
</nav>
     
          
</head>

<body>
      <div class="container">
            <div class="row">
                  <div class="col-lg-12">
                        <h1 class="text-center">Do You want to get the Ahadith on Your Phone?</h1>
                        <h4 class="text-center">Fill the Form Below to Subscribe</h4>      
                  </div>      
            </div>
            <hr>
            <div class="row">
                  <div class="col-lg-12 col-lg-offset-2">
                        <?php echo form_open('/subscribe/submit', ['class'=>'form-horizontal']); ?>
                        <fieldset>
                         <?php if( $error = $this->session->flashdata('failed_message')): ?>
                        <div class="row">
                              <div class="col-lg-6">
                              <div class="alert alert-dismissible alert-danger">
                              <?= $error ?>
                              </div>
                              </div>
                        </div>
                        <?php endif; ?>
                         <?php if( $success = $this->session->flashdata('success_message')): ?>
                        <div class="row">
                              <div class="col-lg-6">
                              <div class="alert alert-dismissible alert-success">
                              <?= $success ?>
                              </div>
                              </div>
                        </div>
                        <?php endif; ?>
                        <div class="row">
                              <div class="col-lg-6 col-lg-offset-2">
                                    <div class="form-group">
                                    <label for="inputName" class="col-lg-2 control-label">Name</label>
                                          <div class="col-lg-6">
                                                <?php echo form_input(['class'=>'form-control','id'=>'inputName','placeholder'=>'Name',
                                                'name' => 'inputName','value' => set_value('inputName')]); ?>
                                          </div>
                                     </div>            
                              </div>
                              <div class="col-lg-6 col-lg-offset-2">
                                    <?php echo form_error('inputName'); ?>
                              </div>
                        </div>
                        
                        <div class="row">
                              <div class="col-lg-6 col-lg-offset-2">
                                    <div class="form-group">
                                    <label for="inputPhone" class="col-lg-2 control-label">Phone</label>
                                          <div class="col-lg-6">
                                                <?php echo form_input(['class'=>'form-control','id'=>'inputPhone','placeholder'=>'Enter Valid No.',
                                                'name'=>'inputPhone','value' => set_value('inputPhone')]); ?>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-lg-6 col-lg-offset-2">
                                    <?php echo form_error('inputPhone'); ?>
                              </div>
                        </div>

                        

                        <div class="form-group">
                              <div class="col-lg-10 col-lg-offset-3">
                                    <?php echo form_reset(['class'=>'btn btn-default','value'=>'Cancel']) ?>
                                    <?php echo form_submit(['class'=>'btn btn-primary','value'=>'Submit']) ?>
                              </div>
                        </div>
                        </fieldset>
                        </form>
                  </div>
            </div>
      </div>





  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>
