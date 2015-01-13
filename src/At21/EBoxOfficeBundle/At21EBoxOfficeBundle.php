<?php

namespace At21\EBoxOfficeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class At21EBoxOfficeBundle extends Bundle
{
    public function getParent()
    {
        return "FOSUserBundle";
    }
}
