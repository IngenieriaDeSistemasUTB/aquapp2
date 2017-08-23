<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Node extends Model
{
    protected $collection = 'nodes';

    protected $fillable = [
        'name',
        'location',
        'coordinates',
        'status',
        'node_type_id',
        'data'
    ];

    protected $casts = [
        'coordinates' => 'array',
        'data' => 'array'
    ];

    /**
     * Get the node_type associated with the given node.
     */
    public function node_type()
    {
        return $this->belongsTo('App\NodeType');
    }

    /**
     * Get the data associated with the given node.
     */
    public function data()
    {
        return $this->hasMany('App\SensorData');
    }
}
