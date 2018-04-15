<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model
{
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * get primary key of object
     * @return [type] [description]
     */
    public function getId()
    {
        return $this->getKey();
    }
}
