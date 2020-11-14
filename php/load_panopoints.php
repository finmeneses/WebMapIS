<?php
    $db = new PDO('pgsql:host=localhost;port=5432;dbname=sdb_panomap', 'postgres', 'M3n3s3s$');
    $sql = $db->query("SELECT id, name, img, url, asset, ST_AsGeoJSON(geom, 5) AS geom FROM panopoints");
    $features=[];
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $feature=['type'=>'Feature'];
        $feature['geometry']=json_decode($row['geom']);
        unset($row['geom']);
        $feature['properties']=$row;
        array_push($features, $feature);
    }
    $featureCollection=['type'=>'FeatureCollection', 'features'=>$features];
    echo json_encode($featureCollection);
?>