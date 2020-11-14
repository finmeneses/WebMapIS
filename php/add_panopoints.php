<?php
    //using AJAX post request
    if (isset($_POST['name'])) {
        $name=$_POST['name'];
    } else {
        $name="NA";
    }
    if (isset($_POST['img'])) {
        $img=$_POST['img'];
    } else {
        $img="NA";
    }
    if (isset($_POST['url'])) {
        $url=$_POST['url'];
    } else {
        $url="NA";
    }
    if (isset($_POST['asset'])) {
        $asset=$_POST['asset'];
    } else {
        $asset="NA";
    }
    if (isset($_POST['latitude']) && is_numeric($_POST['latitude'])) {
        $latitude=$_POST['latitude'];
    } else {
        $latitude="0";
    }
    if (isset($_POST['longitude']) && is_numeric($_POST['longitude'])) {
        $longitude=$_POST['longitude'];
    } else {
        $longitude="0";
    }

    $db = new PDO('pgsql:host=localhost;port=5432;dbname=sdb_panomap', 'postgres', 'M3n3s3s$');
    $sql = $db->prepare("INSERT INTO panopoints (name, img, url, asset, geom) VALUES (:nm, :im, :ur, :ast, ST_SetSRID(ST_MakePoint(:lng, :lat), 4326))");
    $params = ["nm"=>$name, "im"=>$img, "ur"=>$url, "ast"=>$asset, "lng"=>$longitude, "lat"=>$latitude];
    if ($sql->execute($params)) {
        echo "{$name} succesfully added";
    } else {
        echo var_dump($sql->errorInfo());
    };

?>