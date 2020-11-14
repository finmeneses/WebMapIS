<?php
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id=$_POST['id'];
    } else {
        $id="-99999";
    }

    $db = new PDO('pgsql:host=localhost;port=5432;dbname=sdb_panomap', 'postgres', 'M3n3s3s$');
    $sql = $db->query("SELECT id, name, url, img, asset, ST_X(geom) as longitude, ST_Y(geom) as latitude FROM panopoints WHERE id={$id}");
    if ($sql) {
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);
    } else {
        echo var_dump($sql->errorInfo());
    };

?>