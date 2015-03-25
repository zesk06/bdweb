<?php

require 'model/require.php';

/**
 * Insert the last $nb album of the given type
 * type among Ado/Adultes/VO
 */
function insert_last_albums($nb, $type) {
    global $IMG_ROOT; // retrieve IMG_ROOT as global variable
    $album = new Album();
    $albums = $album->get_last_albums($nb, $type);
    echo '<div class="row">';
    // 
    foreach ($albums as $data) {
        echo '<div class="col-md-2">'
        .'<div class="thumbnail">'
        . '<a href="serie.php?idserie=' . $data['idserie'] . '">'
        . '<img class="zoomable" src="'.get_thumbnail("Couvertures", $data['couverture']). '" alt="' . $data['titre'] . '">'
        .'</div>'
        .'</div>';
    }
    echo '</div>';
}


/**
 * Insert the given request serie
 * $idserie the serie to be inserted
 */
function insert_serie($idserie, $idalbum) {
    global $IMG_ROOT; // retrieve IMG_ROOT as global variable
    $serieO = new Serie();
    $data = $serieO->get_serie($idserie);
    echo '<div class="row">';
    echo '<div class="col-md-3" id="leftSerie">'
    . '<a href="serie.php?idserie=' . $data['idserie'] . '">';
    if($data['planche'] == ''){
        echo '<img class="img-thumbnail" src="'.$IMG_ROOT.'/Planches/Encours.jpg" alt="Image en cours"/>';
    }else{
        echo '<img class="img-thumbnail zoomable" src="'.get_thumbnail("Planches", $data['planche']). '" alt="' . $data['titre'] . '">';
        echo '<img class="zoomed" src="'.$IMG_ROOT.'/Planches/'.$data['planche']. '" alt="' . $data['titre'] . '">';
    }
    echo  '</a>'
        . '</div>';
    echo '<div class="col-md-9" id="rightSerie">'
        . '<strong class="text-info">'.utf8_encode($data['titre']).'</strong><br/>'
        . '<span class="label label-default">'.utf8_encode($data['style']).'</span><br/>';
    if ($data['encours'] == 0) {
        echo '<span class="label label-info"   ><span class="glyphicon glyphicon-check"></span>  Série terminée</span><br/>';
    } else if ($data['encours'] == 1){
        echo '<span class="label label-warning"><span class="glyphicon glyphicon-edit" ></span>  Série en cours</span><br/>';
    }else if ($data['encours'] == 2){
        echo '<span class="label label-info"   ><span class="glyphicon glyphicon-check"></span>  ONE-SHOT</span><br/>';
    }
    echo '<small>'.utf8_encode($data['commentaire']).'</small>';
    echo '</div>';
    echo '</div>';
}

function get_thumbnail($folder, $image){
    global $IMG_LOCAL_ROOT;
    global $IMG_ROOT;
    
    //Create thumbnail folder if it not exist
    //$thumbfolder = "$folder/thumbs";
    $thumbfolder = "$IMG_LOCAL_ROOT/$folder/thumbs";
    if (!file_exists($thumbfolder)) {
          @mkdir($thumbfolder, 0777, true);
    }
    $w_filename = "$thumbfolder/m_$image";
    if (!file_exists($w_filename)) { 
        $width = 107;
        $height = 145;
        $im = imagecreatefromjpeg("$IMG_ROOT/$folder/$image");
        if (function_exists('imagecreatetruecolor')) {
            $dst_img = imagecreatetruecolor($width, $height);
        } else {
            $dst_img = imagecreate($width, $height);
        }   
        imagecopyresampled($dst_img,$im,0,0,0,0,$width,$height,imagesx($im),imagesy($im));
        ImageJPEG($dst_img, $w_filename, 75); // 75% quality
    }
    return $w_filename;
}

?>
