<?php
/**
 * This file is part of the Courier project.
 */

namespace Courier;

use Composer\Composer;
use Composer\Installer\LibraryInstaller;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;
use Composer\Util\Filesystem;

/**
 * Class Installer
 *
 * @author Bo Thinggaard <both@fynskemedier.dk>
 */
class Installer extends LibraryInstaller {

	/** @var array */
	protected $paths;

	/**
	 * @param IOInterface $io
	 * @param Composer    $composer
	 * @param string      $type
	 * @param Filesystem  $filesystem
	 */
	public function __construct(IOInterface $io, Composer $composer, $type = 'library', Filesystem $filesystem = null) {
		parent::__construct($io, $composer, $type, $filesystem);

		if ($extra = $this->composer->getPackage()->getExtra()) {
			$this->paths = isset($extra['courier-paths'])
				? $extra['courier-paths']
				: array()
			;
		}
	}

	/**
	 * getPackageBasePath.
	 *
	 * @param PackageInterface $package
	 *
	 * @return string
	 */
	protected function getPackageBasePath(PackageInterface $package) {
		if (isset($this->paths[$package->getType()]) && ($dir = $this->paths[$package->getType()])) {
			@list($vendor, $name) = explode('/', $package->getPrettyName());
			$path = strtr($dir, array(
				'{vendor}' => $vendor,
				'{name}'   => $name
			));
			return rtrim($path, '/');
		}

		if (($extra = $package->getExtra()) && isset($extra['courier-path'])) {
			return rtrim($extra['courier-path'], '/');
		}

		return parent::getPackageBasePath($package);
	}

	/**
	 * supports.
	 *
	 * @param string $packageType
	 *
	 * @return bool
	 */
	public function supports($packageType) {
		return true;
	}
}
