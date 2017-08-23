<?php

namespace App\Http\Transformers;

abstract class Transformer
{
    public function transformCollection($items){
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);

}