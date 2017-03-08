<?php 
include_once 'koneksi.php';
$id_presentasi=0;
if (isset($_GET['id'])) {
  $id_presentasi=$_GET['id'];
}else{
  header('Location: http://localhost/presentasi/filemanager.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Presentasi</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/aplikasi-presentasi.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>

    <div id="mycarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
    <li data-target="#mycarousel" data-slide-to="1"></li>
    <li data-target="#mycarousel" data-slide-to="2"></li>
    <li data-target="#mycarousel" data-slide-to="3"></li>
    <li data-target="#mycarousel" data-slide-to="4"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <?php 
    $query="SELECT * FROM slide WHERE id_presentasi=$id_presentasi ORDER BY part ASC";
    $h=$db->getquery($query);
    //print_r($h);
    foreach ($h as $v) {
    ?>
    <div class="item">
        <img src="... data-color="lightblue" alt="First Image">
        <div class="carousel-caption">
            <div class="slide-content">
                <div class="hider-content">
                  <?php echo $v['judul_slide']; ?>
                  <br>
                  <br>
                </div>
                <?php echo $v['konten_slide']; ?>
            </div>
        </div>
    </div>
    <?php 
      
    } ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var $item = $('.carousel .item'); 
var $wHeight = $(window).height();
$item.eq(0).addClass('active');
$item.height($wHeight); 
$item.addClass('full-screen');

$('.carousel img').each(function() {
  var $src = $(this).attr('src');
  var $color = $(this).attr('data-color');
  $(this).parent().css({
    'background-image' : 'url(' + $src + ')',
    'background-color' : $color
  });
  $(this).remove();
});

$(window).on('resize', function (){
  $wHeight = $(window).height();
  $item.height($wHeight);
});

$('.carousel').carousel({
  interval: 600000000,
  pause: "true"
});
    </script>


</body>

</html>
