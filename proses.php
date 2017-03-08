<?php 
include_once 'koneksi.php';
if (isset($_POST['mode'])) {
	$mode=$_POST['mode'];
	if ($mode=='updateslide') {
		//mode=updateslide&id_presentasi=2&part=1&judul=&foto=null&video=null&konten=
		$id_presentasi=$_POST['id_presentasi'];
		$part=$_POST['part'];
		$judul=$_POST['judul'];
		$konten=$_POST['konten'];
		$foto=$_POST['foto'];
		$video=$_POST['video'];
		$u=$db->runquery("UPDATE `slide` SET `judul_slide`='$judul', `konten_slide`='$konten', `foto_slide`='$foto', `video_slide`='$video', `status_slide`=0 WHERE `id_presentasi`=$id_presentasi AND  `part`= $part");

		if ($u) {
			echo "berhasil udate slide part ".$part;
		}
	}
	if ($mode=='newslide') {
		$id_presentasi=$_POST['id_presentasi'];
		$part=$_POST['part'];
		$i=$db->runquery("INSERT INTO `slide`(`id_presentasi`, `part`, `judul_slide`, `konten_slide`, `foto_slide`, `video_slide`, `status_slide`) VALUES ('$id_presentasi',$part,'null','null','null','null',0)");
		if ($i) {
			echo "berhasil insert part ".$part;
		}
		
	}
	if ($mode=='reparting') {
		$id_presentasi=$_POST['id_presentasi'];
		//echo $_POST['parting'];
		$pecah=explode(";", $_POST['parting']);
		echo "sd".$pecah[1];
		foreach ($pecah as $key => $value) {
			if ($key>0) {
				$db->runquery ("UPDATE `slide` SET  `part`= $key WHERE `id_presentasi`=$id_presentasi AND `judul_slide`='$value'");
			}
		}
	}
}

?>