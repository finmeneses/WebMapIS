<?php
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
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id=$_POST['id'];
    } else {
        $id="-9999";
    }


    $db = new PDO('pgsql:host=localhost;port=5432;dbname=sdb_panomap', 'postgres', 'M3n3s3s$');
    $sql = $db->prepare("UPDATE panopoints SET name=:nm, img=:im, url=:ur, asset=:ast, geom=ST_SetSRID(ST_MakePoint(:lng, :lat), 4326) WHERE id=:id");
    $params = ["nm"=>$name, "im"=>$img, "ur"=>$url, "ast"=>$asset, "lng"=>$longitude, "lat"=>$latitude, "id"=>$id];
    if ($sql->execute($params)) {
        echo "{$name} succesfully updated";
    } else {
        echo var_dump($sql->errorInfo());
    };

?>