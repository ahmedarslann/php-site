<?php

require 'config.php';
require 'start_html.php';




$albumler = $database->query("SELECT * FROM albumler")->fetchAll(PDO::FETCH_ASSOC);

echo '<div class="icerik">';

if (empty($_GET)) {

  foreach ($albumler as  $album) {
	
	echo '<div class="album">';
	echo '<a href="/?album='.$album['album_id'].'">'.$album['album_adi'].'</a><hr> ';
	echo '<a href="/?album='.$album['album_id'].'">';
	echo '<img src="/images/'.$album['album_id'].'.jpg" height="200" width="150" alt="'.$album['album_adi'].'" title="'.$album['album_adi'].'">';
	echo "</a>";
	echo '</div>';
   }
}elseif (!empty(@$_GET['album'] and is_numeric(@$_GET['album']))) {
	
	$album_adi = $database->query("SELECT album_adi FROM albumler WHERE album_id=$_GET[album]")->fetchAll(PDO::FETCH_ASSOC);
	@$sarkilar = $database->query("SELECT sarki_adi,sarki_id FROM sarkilar WHERE album_id=$_GET[album]")->fetchAll(PDO::FETCH_ASSOC);

	$album_adi = $album_adi[0]['album_adi'];
	
	echo '<h3>'.$album_adi.'</h3><br>';

    echo '<ul>';
	foreach ($sarkilar as $key => $sarki) {
		$key = $key+1;
		echo '<li><a href="/?sarki='.$sarki['sarki_id'].'">';
		echo $key.'. '.$sarki['sarki_adi'].'<br>';
		echo '</a></li>';
	}
	echo '</ul>';

}elseif (!empty(@$_GET['sarki'] and is_numeric(@$_GET['sarki']))) {
	
	$sarki = $database->query("SELECT sarki_adi,album_id,sozler FROM sarkilar WHERE sarki_id=$_GET[sarki]")->fetchAll(PDO::FETCH_ASSOC);
    
    $album_id = $sarki[0]['album_id'] ;

	$album_adi = $database->query("SELECT album_adi FROM albumler WHERE album_id=$album_id")->fetchAll(PDO::FETCH_ASSOC);

 
	echo '<h3>'.$album_adi[0]['album_adi'].' > '.$sarki[0]['sarki_adi'].'</h3><br>';

	echo '<div class="sozler">';
    echo  $sarki[0]['sozler'];
	echo '</div>';

} 

echo "</div>";


require 'finish_html.php';

?>