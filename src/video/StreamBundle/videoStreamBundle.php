<?php

namespace video\StreamBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class videoStreamBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
