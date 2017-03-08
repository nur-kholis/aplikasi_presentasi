<?php 
include_once 'koneksi.php';
if (isset($_GET['edit'])) {
   
}else{
    $last_id_presentation=$db->nextid("presentasi","id_presentasi");
    //echo $last_id_presentation;
    //memasukkan data presentasi baru kedalam database
    $i=$db->runquery("INSERT INTO `presentasi`(`id_presentasi`, `judul_presentasi`, `status_presentasi`) VALUES ('$last_id_presentation','null',0)");
    if ($i) {
        //echo "string";
        $db->runquery("INSERT INTO `slide`(`id_presentasi`, `part`, `judul_slide`, `konten_slide`, `foto_slide`, `video_slide`, `status_slide`) VALUES ('$last_id_presentation',1,'null','null','null','null',0)");
    }
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

    <nav class="navbar navbar-default" role="navigation">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li id="btn_tambah_slide">
                    <span class="fa fa-plus fa-2x"></span>
                </li>
                <li id="btn_new_slide">
                    <span class="fa fa-file-powerpoint-o  fa-2x"></span>
                </li>
                <li>
                    <span class="fa fa-save fa-2x"></span>
                </li>
                <li>
                    <span class="fa fa-camera fa-2x"></span>
                </li>
                <li>
                    <span class="fa fa-video-camera fa-2x"></span>
                </li>
                <li>
                    <span class="fa fa-folder fa-2x"></span>
                </li>
                <li id="btn_slide_show">
                    <span class="fa fa-play fa-2x"></span>
                </li>
                <li>
                    <span class="fa fa-bullhorn fa-2x"></span>
                </li>
            </ul>
        </div>
    </nav>
  
    <div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <div class="presentasion-slide">
                    <div class="well well-active" data-part="1" data-konten="null" data-foto="null" data-video="null" data-update="0"><input type="text" name="" id="input" placeholder="enter title" class="form-control" value="" required="required" pattern="" title="" value=""></div>
                </div>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <textarea id="kontent_presentasi"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        


    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/ckeditor/ckeditor.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script>
    /*$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });*/
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            function lastpart(){
                var lsp=1;
                 $(".presentasion-slide div").each(function(index) {
                    lsp=$(this).data('part');
                });
                 return lsp;
            }

            var part=lastpart();
            //alert('lastpart '+part);

            $("#btn_tambah_slide").click(function(){
                 part++;
                 var slide_html='<div class="well" data-part="'+part+'" data-konten="" data-foto="" data-video="" data-update="0"><input type="text" name="" id="input" placeholder="enter title" class="form-control" value="" required="required" pattern="" title=""></div>'; 
                 $(".presentasion-slide").append(slide_html);
                 var dt='mode=newslide&id_presentasi=<?php echo $last_id_presentation ?>&part='+part;
                 generateSlide();
                 insertNewSlide(dt);
            });

            $("#btn_slide_show").click(function() {
                //script ini tidak memvalidasi persamaan judul
                generateSlide();
                var drp="mode=reparting&id_presentasi=<?php echo $last_id_presentation; ?>&parting=";
                $(".presentasion-slide div").each(function(index) {
                    drp=drp+";"+$( this ).find('input').val();
                });
                console.log(drp);
                reparting(drp);
                window.location.href='http://localhost/presentasi/slideshow.php?id=<?php echo $last_id_presentation ?>';
            });

            $(".presentasion-slide").on('click', 'div', function(event) {
                event.preventDefault();
                generateSlide();
                $(this).addClass('well-active');
                $(this).data('update', '0');
                CKEDITOR.instances['kontent_presentasi'].setData($(this).data('konten'));
            });

            function generateSlide() {
                var kontent_presentasi=CKEDITOR.instances['kontent_presentasi'].getData();
                $(".presentasion-slide div").each(function(index) {
                    if ($(this).hasClass('well-active')) {
                        $(this).data('konten',kontent_presentasi);
                        $(this).removeClass('well-active');
                    }
                    if ($(this).data('update')=='0') {
                        var konten=$(this).data('konten');
                        var foto=$(this).data('foto');
                        var video=$(this).data('video');
                        var part=$(this).data('part');
                        var judul=$(this).find('input').val();

                        var dataupdate='mode=updateslide&id_presentasi=<?php echo $last_id_presentation ?>&part='+part+'&judul='+judul+'&foto='+foto+'&video='+video+'&konten='+konten;
                        //console.log(dataupdate);
                        updateSlide(dataupdate);
                        $(this).data('update', '1');
                    }
                });
            }

            function updateSlide(dataupdate){
                $.ajax({
                    type: 'POST',
                    url: ('http://localhost/presentasi/proses.php'),
                    data: dataupdate,
                    success:function(data){
                        console.log(data);
                    }
                });
            }

            function insertNewSlide(dt){
                 $.ajax({
                    type: 'POST',
                    url: ('http://localhost/presentasi/proses.php'),
                    data: dt,
                    success:function(data){
                        console.log(data);
                    }
                });
            }

            function reparting(dt){
                 $.ajax({
                    type: 'POST',
                    url: ('http://localhost/presentasi/proses.php'),
                    data: dt,
                    success:function(data){
                        console.log(data);
                    }
                });
            }

            CKEDITOR.replace( 'kontent_presentasi' );

            $(function () {
                $(".presentasion-slide").sortable({
                    tolerance: 'pointer',
                    revert: 'invalid',
                    placeholder: '',
                    forceHelperSize: true
                });
            });

            $("#btn_new_slide").click(function() {
                 window.open("http://localhost/presentasi");
            });

        });
    </script>


</body>

</html>
