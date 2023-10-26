<?php

namespace App\Http\Requests\Traits;

trait MergeWithGlobalRequest
{

    public function merge(array $input)
    {
        return parent::merge(
            request()->merge($input)->all()
        );
    }

}
