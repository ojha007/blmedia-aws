<?php

namespace Modules\Backend\Entities;

class Reporter extends Contact
{


    protected $type = 'Reporters';

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

}
