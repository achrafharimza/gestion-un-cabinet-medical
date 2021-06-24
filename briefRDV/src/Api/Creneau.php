<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: applecation/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-Width');

include_once '../Database/Database.php';
include_once '../Modele/RDV.php';

$database   =   new Database();
$db         =   $database->connect();
$RDV       =   new RDV($db);
$data   =   json_decode(file_get_contents("php://input"));


$result     =   $RDV->ReadCreneau($data->Date);

$count=$result->rowCount();

    $rdv_arr          =   array();
    $rdv_arr['data']  =   array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $rdva  = array(
            'Num_creneau'     => $Num_creneau,
            'heure'     => $heure
        );
        array_push($rdv_arr['data'],$rdva);
    }

    echo json_encode($rdv_arr['data']);