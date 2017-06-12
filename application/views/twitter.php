<!DOCTYPE html>
<html lang="en">
<head>
	 <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Telegram</title>
    <link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
        integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>


    <div class="container">
        <?php echo form_open_multipart('twitter/send', ['class'=>'form-horizontal']) ?>
        <?= form_hidden('created_at', date('Y-m-d H:i:s')) ?>
    <fieldset>
        <legend>Twitter</legend>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                <label for="inputEmail" class="col-lg-4 control-label">Write Tweet</label>
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