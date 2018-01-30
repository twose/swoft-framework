<?php

namespace Swoft\Bean\Resource;

use Swoft\Helper\ComponentHelper;

/**
 * The annotation resource of server
 */
class ServerAnnotationResource extends AnnotationResource
{
    /**
     * Register the scaned namespace
     */
    public function registerNamespace()
    {
        $swoftDir      = dirname(__FILE__, 5);
        $componentDirs = scandir($swoftDir);
        foreach ($componentDirs as $component) {
            if ($component == '.' || $component == '..') {
                continue;
            }

            $componentCommandDir = $swoftDir . DS . $component . DS . 'src';
            if (!is_dir($componentCommandDir)) {
                continue;
            }

            $componentNs                 = ComponentHelper::getComponentNs($component);
            $ns                          = "Swoft{$componentNs}";
            $this->componentNamespaces[] = $ns;

            // console component
            if ($component == $this->consoleName) {
                $this->scanNamespaces[$ns] = $componentCommandDir;
                continue;
            }

            foreach ($this->serverScan as $dir) {
                $scanDir = $componentCommandDir . DS . $dir;
                if (!is_dir($scanDir)) {
                    continue;
                }

                $scanNs                        = $ns . "\\" . $dir;
                $this->scanNamespaces[$scanNs] = $scanDir;
            }
        }
        var_dump($this->scanNamespaces);
    }
}