<?php

namespace Notify\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NotifyUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
