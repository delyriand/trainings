<?php

namespace Training\Bundle\CheckoutBundle\Condition;

use Oro\Component\ConfigExpression\Condition\AbstractComparison;

class PregMatch extends AbstractComparison
{
    protected function doCompare($left, $right)
    {
        return (bool) preg_match(sprintf('/%s/', trim($right, '/')), $left);
    }

    public function getName()
    {
        return 'training_preg_match';
    }
}