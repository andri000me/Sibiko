<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>

        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/bootstrap/css/bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/font-awesome/css/font-awesome.min.css')?>">
		    <link rel="stylesheet" href="<?php echo base_url('assets/theme/css/form-elements.css')?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/theme/css/style.css')?>">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url('assets/theme/ico/favicon.png')?>">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('assets/theme/ico/apple-touch-icon-144-precomposed.png')?>">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('assets/theme/ico/apple-touch-icon-114-precomposed.png')?>">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('assets/theme/ico/apple-touch-icon-72-precomposed.png')?>">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('assets/theme/ico/apple-touch-icon-57-precomposed.png')?>">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><strong>SISTEM BIMBINGAN DAN KONSELING</strong></h1>
                            <h1><strong>SMKN 2 BOJONEGORO</strong></h1>   
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                             <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Wali Siswa</a></li>
                              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Siswa</a></li>
                            </ul>
                            <div class="tab-content">
                              <div role="tabpanel" class="tab-pane active" id="home">
                                <h4>Login sebagai Wali Siswa</h4>
                                <p>silahkan Masukkan Username dan Password:</p>
                              <form action="<?php echo $action ?>" method="post">
                               <div class="form-group has-feedback">
                                   <input type="text" name="username" 
                                          class="form-control" placeholder="Username" autofocus="" />
                                 <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                               </div>
                               <div class="form-group has-feedback">
                                   <input type="password" name="password" 
                                          class="form-control" placeholder="Password"/>
                                 <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                               </div>
                               <div class="row">
                               <div class="col-xs-12">
                                   <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                               </div><!-- /.col -->
                           </div>
                              </form>
                              </div>
                              <div role="tabpanel" class="tab-pane" id="profile">
                                <h4>Login sebagai Siswa</h4>
                                <p>silahkan Masukkan Username dan Password:</p>
                                <form action="<?php echo $action2 ?>" method="post">
                               <div class="form-group has-feedback">
                                   <input type="text" name="username" 
                                          class="form-control" placeholder="NIS..." autofocus="" />
                                 <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                               </div>
                               <div class="form-group has-feedback">
                                   <input type="password" name="password" 
                                          class="form-control" placeholder="Password"/>
                                 <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                               </div>
                               <div class="row">
                               <div class="col-xs-12">
                                   <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                               </div><!-- /.col -->
                           </div>
                              </form>
                              </div>
                            </div>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
                            
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="<?php echo base_url('assets/theme/js/jquery-1.11.1.min.js')?>"></script>
        <script src="<?php echo base_url('assets/theme/bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('assets/theme/js/jquery.backstretch.min.js')?>"></script>
        <script src="<?php echo base_url('assets/theme/js/scripts.js')?>"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/theme/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>