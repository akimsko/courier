Courier Composer Plugin.
======================


This composer installer will install any package-type, to any path you wish.

It can be any of composers built-in package-types, or you can invent your own package-types, as you see fit.

In order for this plugin to work, it must be required in the package that specifies the custom install paths.

Like so...

```javascript
{
  ...
  "require": {
    "akimsko/courier": "~1.0"
  }
}
```


From here, you can override install paths for all package-types required by this package, by defining them in the extra section.

The extra-option is ```courier-paths```, and must contain one or more entries of ```<package-type>: <directory>```.

To insert the package name in the path use ```{name}``` (The package name after the '/').

To insert the vendor name in the path use ```{vendor}``` (The package name before the '/').


Like so...

```javascript
{
  ...
  "extra": {
    "courier-paths": {
      "my-custom-module-type": "modules/{vendor}-{name}",
      "my-custom-theme-type": "theme/{name}"
      "library": "lib/{vendor}/{name}"
    }
  }
}
```

This will install all packages of type ```my-custom-module-type``` to ```<projectroot>/modules/<vendor-name>-<package-name>```.

All packages of type ```my-custom-theme-type``` to ```<projectroot>/themes/<package-name>```.

And finally all packages of type ```library``` to ```<projectroot>/lib/<vendor-name>/<package-name>```.


If a package-type does not match anything in courier-paths extra section, it will be installed to the default vendor path as normal.
