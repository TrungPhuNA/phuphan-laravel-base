<?php

namespace App\Repositories\Eloquent;

use App\Models\Appearance\Page;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\SettingPageRepositoryInterface;

class SettingPageRepository extends BaseRepository implements SettingPageRepositoryInterface
{
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }
}