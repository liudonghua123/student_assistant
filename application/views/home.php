<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>
<style>

    html{
        height: 100%;
        overflow-y: hidden;
    }
    body {
        min-height: 100%;
    }

    /* http://www.w3cplus.com/css3/create-butter-fly-with-css3-animations */
    .butterfly { width: auto; height: 500px; margin: 0 auto; overflow: hidden; }
    .butter1, .butter2, .butter3 {
        position: relative;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: linear;
        display: none\9; *display: none;
    }
    .butter1 { -webkit-animation-name: butter1; -webkit-animation-duration: 30s; -webkit-transform: rotateZ(-30deg); }
    .butter2 { -webkit-animation-name: butter2; -webkit-animation-duration: 40s; -webkit-transform: rotateZ(-30deg); }
    .butter3 { -webkit-animation-name: butter3; -webkit-animation-duration: 50s; -webkit-transform: rotateZ(30deg); }
    .butterfly1, .butterfly2, .butterfly3 {
        position: absolute;
        -webkit-animation-name: x-spin;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: ease-linear;
    }
    .butterfly1 { height: 36px; left: 40px; bottom: 60px; -webkit-animation-duration: 0.4s; }
    .butterfly2 { height: 40px; left: 80px; bottom: 10px; -webkit-animation-duration: 0.4s; }
    .butterfly3 { height: 40px; right: 60px; bottom: 10px; -webkit-animation-duration: 0.32s; }

    @-webkit-keyframes x-spin {
        0%        { -webkit-transform: rotateX(0deg); }
        20%        { -webkit-transform: rotateX(80deg); }
        40%        { -webkit-transform: rotateX(130deg); }
        50%        { -webkit-transform: rotateX(180deg); }
        60%        { -webkit-transform: rotateX(210deg); }
        80%        { -webkit-transform: rotateX(270deg); }
        100%    { -webkit-transform: rotateX(360deg); }
    }
    @-webkit-keyframes butter1 {
        0%        { opacity: 0; }
        10%        { left: 160px; bottom: 80px; opacity: 1; }
        20%        { left: 240px; bottom: 45px; }
        30%        { left: 400px; bottom: 15px; }
        60%        { left: 720px; bottom: -5px; }
        70%        { left: 800px; bottom: 30px; }
        80%        { left: 840px; bottom: 0px; opacity: 0.6; }
        100%    { left: 900px; bottom: 40px; opacity: 0; }
    }
    @-webkit-keyframes butter2 {
        0%        { opacity: 0; }
        10%        { left: 120px; bottom: 40px; opacity: 1; }
        40%        { left: 180px; bottom: 20px; }
        50%        { left: 360px; bottom: 0px; }
        60%        { left: 600px; bottom: -10px; }
        80%        { left: 640px; bottom: 20px; opacity: 0.6; }
        100%    { left: 860px; bottom: 30px; opacity: 0; }
    }
    @-webkit-keyframes butter3 {
        0%        { opacity: 0; }
        10%        { right: 160px; bottom: 30px; opacity: 1; }
        20%        { right: 200px; bottom: 10px; }
        40%        { right: 400px; bottom: 0px; }
        60%        { right: 620px; bottom: -10px; }
        70%        { right: 700px; bottom: 10px; opacity: 0.6; }
        100%    { right: 840px; bottom: 60px; opacity: 0; }
    }

</style>
</head>
<body style="padding: 0px;">

<?php echo $this->load->view('header'); ?>

<script src="<?php echo base_url().RES_DIR; ?>/js/widgets.js"  id="twitter-wjs" ></script>
<script src="<?php echo base_url().RES_DIR; ?>/js/processing.min.js"></script>
<script src="<?php echo base_url().RES_DIR; ?>/js/apt18.js" ></script>
<script src="<?php echo base_url().RES_DIR; ?>/js/modernizr-0.9.min.js"></script>

<!-- style="z-index: 0;" -->
<canvas id="theapt" width="1366px" height="500px" style="z-index: -1; position: absolute; top: 40px;"></canvas>
<audio id="audio" src="<?php echo base_url().RES_DIR; ?>/media/thankyou.ogg"></audio>

<!--
<div class="butterfly">
    <div class="butter1">
        <div class="butterfly1"><img src="<?php echo base_url().RES_DIR; ?>/img/butterfly1.png" /></div>
    </div>
    <div class="butter2">
        <div class="butterfly2"><img src="<?php echo base_url().RES_DIR; ?>/img/butterfly2.png" /></div>
    </div>
    <div class="butter3">
        <div class="butterfly3"><img src="<?php echo base_url().RES_DIR; ?>/img/butterfly3.png" /></div>
    </div>
</div>
-->

<div class="container" style="top: 550px; position: absolute; left: 0; right: 0;">
    <h1 style="display: inline;">Welcome to <?php echo lang('website_title'); ?></h1>
</div>

<!--
<?php echo $this->load->view('footer'); ?>
-->
</body>
</html>