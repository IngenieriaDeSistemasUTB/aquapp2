<?php

use App\SensorData;

function getSensors(){
    $sensors = [];

    $json = File::get("../database/data/sensors.json");
    $data = json_decode($json);

    foreach ($data as $obj) {
        $sensors[] = $obj;
    }

    return $sensors;
}

function getFilteredData($request)
{
    $nodeId = $request->input('node_id');
    $variable = $request->input('variable');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $startDate = date("YmdHis", strtotime($startDate));
    $endDate = date("YmdHis", strtotime($endDate));

    $sensorData = SensorData::where('node_id', $nodeId)
        ->where('variable', $variable)
        ->whereBetween('data.timestamp', array($startDate, $endDate))
        ->first();

    /*
     * Filter data
     */
    $data = [];

    if($sensorData)
    {
        foreach($sensorData['data'] as $key => $datum)
        {
            if($datum['timestamp'] >= $startDate && $datum['timestamp'] <= $endDate)
            {
                $data[] = $datum;
            }

        }
    }

    /*
     * Sort data
     */
    function cmp($item1, $item2) {
        $ts1 = strtotime($item1['timestamp']);
        $ts2 = strtotime($item2['timestamp']);
        return $ts2 - $ts1;
    }

    usort($data, "cmp");

    $sensorData['data'] = $data;

    return $sensorData;
}