<?php
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id=$_POST['id'];
    } else {
        $id="-9999";
    }

    $db = new PDO('pgsql:host=localhost;port=5432;dbname=sdb_panomap', 'postgres', 'M3n3s3s$');
    $sql = $db->prepare("DELETE FROM panopoints WHERE id=:id");
    $params = ["id"=>$id];
    if ($sql->execute($params)) {
        echo "Attraction succesfully deleted";
    } else {
        echo var_dump($sql->errorInfo());
    };

?>