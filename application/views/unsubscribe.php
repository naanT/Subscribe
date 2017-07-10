<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sayings of the Messenger P.B.U.H</title>
     <link rel="stylesheet" href="https://bootswatch.com/slate/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
     <?= link_tag('assets/css/intlTelInput.css') ?>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/intlTelInput.js" ></script>


     <script type="text/javascript">

    $(document).ready(function() {
     $(".submit").click(function(event) {
       event.preventDefault();


         var str=document.getElementsByClassName("selected-flag")[0].title;
         var code=str.substr(str.indexOf("+") + 0);
         var phone=$("#phone").val();
         var temp=phone.toString();
         if(temp.startsWith("0"))
         {
           phone=phone.substring(1);
           phone=Number(phone);
         }



         phone=code+phone;

         console.log("str:"+str);
         console.log("code:"+code);
         console.log("phone:"+phone);

           jQuery.ajax({
             type: "POST",
             url: "<?php echo base_url(); ?>" + "unsubscribe/submit",
             data:
             {
               phone: phone
             },
           success: function(res) {
                     console.log(res);
                     if(res == "You are Now Unsubscribed!")
                     {
                       document.getElementById('validPassword').style.visibility='visible';
                       document.getElementById('texts').innerHTML=res;
                       document.getElementById('validName').style.visibility='hidden';
                     }
                     else
                       {
                         document.getElementById('validName').style.visibility='visible';
                         document.getElementById('textd').innerHTML=res;
                         document.getElementById('validPassword').style.visibility='hidden';
                       }
          },
          error: function(){
               alert("error");
          }
         });
   });
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
                        <h4 class="text-center">Fill the Form Below to UnSubscribe</h4>
                  </div>
            </div>
            <hr>
            <div style="visibility:hidden;" class="row col-lg-offset-2
            alert alert-dismissible alert-danger" id="validName">
              <p id="textd"></p>
            </div>
            <div style="visibility:hidden;" class="row col-lg-offset-2
            alert alert-dismissible alert-success" id="validPassword">
              <p id="texts"></p>
            </div>

            <div class="row">
                  <div class="col-lg-12 col-lg-offset-2">
                        <?php echo form_open('/unsubscribe/submit', ['class'=>'form-horizontal','id'=>'subscribeForm']); ?>
                        <fieldset>
                        <div class="row">
                              <div class="col-lg-6 col-lg-offset-2">
                                    <div class="form-group">
                                    <label for="phone" class="col-lg-2 control-label">Phone</label>
                                          <div class="col-lg-6">
                                                <?php echo form_input(['class'=>'form-control','id'=>'phone','placeholder'=>'Enter Valid No.',
                                                'name'=>'phone','type'=>'tel','value' => set_value('phone')]); ?>
                                          </div>
                                    </div>
                              </div>
                        </div>

                        <div class="form-group">
                              <div class="col-lg-10 col-lg-offset-3">
                                    <?php echo form_reset(['class'=>'btn btn-default','value'=>'Cancel']) ?>

                              <?php echo form_submit(['class'=>'btn btn-primary submit','value'=>'Submit','name'=>'submit',
                              'id'=>'submit']) ?>
                              </div>
                        </div>
                        </fieldset>
                        </form>
                  </div>
            </div>
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>assets/js/intlTelInput.js" ></script>
      <script>
      $("#phone").intlTelInput();
      </script>
      <script>
      $("#phone").intlTelInput({
        utilsScript: "http://localhost/subscribe/assets/js/util.js"
      });
      </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous">
</script>
</body>
</html>
