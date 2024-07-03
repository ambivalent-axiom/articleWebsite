<?php
namespace Ambax\articleWebsite;
use DI\ContainerBuilder;

return function()
{
    $containerBuilder = new ContainerBuilder();
    $containerBuilder->addDefinitions([
        //TODO add definitions for controllers
    ]);
    return $containerBuilder->build();
};