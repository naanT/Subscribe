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


<script type="text/javascript">
    var no_of_contacts = 0;
    var name="";
    var phone="";
    var txt="";
    $(document).ready(function() {
      $.get("<?php echo base_url(); ?>" + "message/getcontacts",
            function(result, status){
                myObj = JSON.parse(result);

                no_of_contacts=myObj.length;
                var component="";
                var temp="no";
                var no=1;
                for (x in myObj) {

                  component+='<tr>';
                  component+='<td>';
                  component+='<input type="checkbox"';
                  component+='id=';
                  component+=temp+no;
                  component+=' value=';
                  component+=myObj[x].phone ;
                  component+='>';
                  component+=myObj[x].name ;
                  component+='</td>';
                  component+='<td>';
                  component+='<button class="btn btn-info col-lg-2 info">info</button>';
                  component+='</td>';
                  component+='</tr>';
                  no+=1;
                  document.getElementById("r").innerHTML =component;
                }
            });
      $(".submit").click(function(event) {
        event.preventDefault();
        var number= new Array();
         for (var i = 1; i<=no_of_contacts; i++) {
            number[i-1] = $("#no"+i) .val();
        }
            var textarea = $('#textArea').val();

        jQuery.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>" + "message/submit",
          data:
          {
            text_message : textarea,
            phone        : JSON.stringify(number)
          },
        success: function(res) {
          alert("sending...");
          $.get("<?php echo base_url(); ?>" + "message/savestatus",
                function(res, status){
                  console.log(res);
                });
       },
       error: function(){
            alert("error");
       }
      });
    });
        window.setInterval(function(){
          $.get("<?php echo base_url(); ?>" + "message/getstatus",
                  function(result, status){
                    var textstatus=JSON.parse(result);
                    console.log(textstatus.length);

                    for (var i = 0; i < textstatus.length; i++) {
                      var ele=document.getElementsByClassName("info");
                      
                      ele[i].innerHTML=textstatus[i];
                    }
                  });
            }, 5000);

    });
  </script>

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
        <li class="active"><a href="<?php echo site_url('message') ?>">Message</a></li>
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
          <h1 class="text-center">Sayings of the Messenger P.B.U.H</h1>
        </div>
    </div>
    <hr>
    
    <div class="row"> 
      <?php echo form_open('message/submit',['class' => 'form-horizontal']) ;?>
        <fieldset>

        <div class="col-lg-12 col-lg-offset-2"> 
          <div class="form-group">
            <div class="col-lg-8">
                <?php echo form_textarea(['class' => 'form-control' ,
                'id' => 'textArea' ,'rows' => 10 , 'name' => 'messageText' , 'placeholder' => 'Write Hadith Here']); ?>
            </div>
          </div>
        </div>

          

          <div class="col-lg-8 col-lg-offset-2">
            <table class="table table-striped table-hover ">
                <tbody id="r">
                </tbody>
            </table>
          </div>
            

          <div class="col-lg-8 col-lg-offset-3">
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                  <?php echo form_reset('reset', 'Cancel',['class' => 'btn btn-default']);
                  echo form_submit(['name' => 'submit', 'value' => 'Submit',
                                  'class' => 'btn btn-primary submit']); ?>
              </div>
            </div>
         </div>

        </fieldset>
        <?php echo form_close();?>

    </div>
        
    </div>
    <!--<script>
            CKEDITOR.replace( 'editor1' );
        </script>-->
  </body>
</html>
