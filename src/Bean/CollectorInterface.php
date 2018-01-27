<?php

namespace Swoft\Bean;

/**
 * Annotaions data collector
 */
interface CollectorInterface
{
    /**
     * @param string $className
     * @param object|null $objectAnnotation
     * @param string $propertyName
     * @param string $methodName
     * @param null $propertyValue
     * @return void
     */
    public static function collect(
        string $className,
        $objectAnnotation = null,
        string $propertyName = '',
        string $methodName = '',
        $propertyValue = null
    );

    /**
     * @return mixed
     */
    public static function getCollector();
}