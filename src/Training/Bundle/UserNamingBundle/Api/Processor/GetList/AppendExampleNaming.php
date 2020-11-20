<?php

namespace Training\Bundle\UserNamingBundle\Api\Processor\GetList;

use Oro\Component\ChainProcessor\ContextInterface;
use Oro\Component\ChainProcessor\ProcessorInterface;

class AppendExampleNaming implements ProcessorInterface
{

    public function process(ContextInterface $context)
    {
        $result = $context->getResult();
        foreach ($result as &$item) {
            $item['example'] = "test";
        }

        $context->setResult($result);
    }
}