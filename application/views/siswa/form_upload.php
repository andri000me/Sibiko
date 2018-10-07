<html>
<head>
	<title>CARIKODE</title>
</head>
<body>
 
	<?php echo $error; ?>
 
	<form action='<?php base_url(); ?>do_upload' enctype="multipart/form-data" method="POST">
	<div class="form-group">
              <label class="control-label col-md-3">Foto</label>
              <div class="col-md-9">
                <input name="userfile" class="form-control" type="file">
              </div>
            </div>
	<input type="submit" value="upload" />
 
</form>
 
</body>
</html>