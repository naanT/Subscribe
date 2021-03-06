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
       <script src="https://code.jquery.com/jquery-1.10.2.js"></script>



<script type="text/javascript">

var entityMap = {
   '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": "&#39;",
  '/': '&#x2F;'
};

function escapeHtml (string) {
  return String(string).replace(/[&<>"'\/]/g, function (s) {
    return entityMap[s];
  });
}
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
                  component+=' name=';
                  component+='foo';
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
        var count=0;
        console.log("no of contacts:"+ no_of_contacts);
         for (var i = 0; i<no_of_contacts; i++) {
           if($('#no' + (i+1)).is(":checked")==true)
           {
             number[count] = $("#no"+ (i+1)).val();
             count=count+1;
           }
        }
        console.log("number:"+ number);
            var textarea1 = $('#textArea').val();

            var textarea= escapeHtml(textarea1);
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
  <script type="text/javascript">
  function toggle(source) {
  checkboxes = document.getElementsByName('foo');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
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
      <?php echo form_prep('message/submit',['class' => 'form-horizontal','accept-charset'=>'UTF-8']) ;?>
        <fieldset>

        <div class="col-lg-12 col-lg-offset-2">
          <div class="form-group">
            <div class="col-lg-8">
                <?php echo form_textarea(['class' => 'form-control' ,
                'id' => 'textArea' ,'rows' => 10 , 'name' => 'messageText' , 'placeholder' => 'Write Hadith Here']); ?>
            </div>
          </div>
        </div>

        <div style="height:6px;">

        </div>

        <div class="row">
          <div class="col-lg-8 col-lg-offset-2">
            <input type="checkbox" onClick="toggle(this)" /> Check All<br/>
          </div>
        </div>

        <div style="height:35px;">

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
