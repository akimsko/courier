<?php
/**
 * This file is part of the Courier project.
 */

namespace Courier;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Class Plugin
 *
 * @package Courier
 * @author  Bo Thinggaard <akimsko@gmail.com>
 */
class Plugin implements PluginInterface
{

    /**
     * activate.
     *
     * @param Composer    $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $composer->getInstallationManager()->addInstaller(new Installer($io, $composer));
    }
}