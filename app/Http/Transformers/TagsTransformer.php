<?php

namespace App\Http\Transformers;

class TagsTransformer extends Transformer
{

    public function transform($item)
    {
        return [
            'name'     => $item['name'],
        ];
    }
}