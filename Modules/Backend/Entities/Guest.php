<?php

namespace Modules\Backend\Entities;

class Guest extends Contact
{

    protected $type = 'Guests';

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

}
