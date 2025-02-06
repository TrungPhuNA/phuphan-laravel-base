<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface VariantAttributeRepositoryInterface extends BaseRepositoryInterface
{
    public function checkExistsAttributeValue($conditions);
    public function updateAttributeValue($conditions, $updateDto);
}