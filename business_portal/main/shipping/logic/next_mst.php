<?php
require_once '../../connect.php';
require_once '../model/shipping_data.php';

$shipord = get_last_shipord() ;
$mst = $shipord['mst'];
$next_mst = $mst + 1;
$data['next_mst'] = $next_mst;
echo json_encode($data);

?>