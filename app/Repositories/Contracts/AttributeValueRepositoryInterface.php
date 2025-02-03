<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface AttributeValueRepositoryInterface extends BaseRepositoryInterface
{
    public function insert($modelDto);
    public function getListsByAttributeId($attributeID);
    public function checkExistsAttributeValue($params);
    public function updateAttributeValue($params, $modelDto);
}