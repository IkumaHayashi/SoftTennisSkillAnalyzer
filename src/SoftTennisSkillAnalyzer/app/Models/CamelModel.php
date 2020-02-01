<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

/**
 * Class CamelModel.
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
abstract class CamelModel extends EloquentModel
{

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function getAttribute($key)
    {
        return parent::getAttribute(Str::snake($key));
    }
    
    public function setAttribute($key, $value)
    {
        return parent::setAttribute(Str::snake($key), $value);
    }    
}