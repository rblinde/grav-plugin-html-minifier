# HTML Minifier Plugin

The **HTML Minifier** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). It minifies the HTML output of your Grav site.

## Installation

Installing the HTML Minifier plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install html-minifier

This will install the HTML Minifier plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/html-minifier`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `html-minifier`. You can find these files on [GitHub](https://github.com/rblinde/grav-plugin-html-minifier) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/html-minifier

> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/rblinde/grav-plugin-html-minifier/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/html-minifier/html-minifier.yaml` to `user/config/plugins/html-minifier.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
cache: # whether to store minifed HTML in cache
mode: # compression mode: default|fastest|smallest
```

Note that if you use the Admin Plugin, a file with your configuration named html-minifier.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

### Individual Page

The default configuration can be overwritten on a per-page basis. To disable caching, add the following to the frontmatter of the page:

```yaml
---
html-minifier:
  cache: false
---
```

You want to disable the cache functionality on pages which have a form. Otherwise forms can only be sent once.

## Usage

After installation you can modify the plugin settings by copying and editing `html-minifier.yaml` or directly in the Admin. By default, the plugin will use the default compressor and will not store the minified HTML in cache.

## Credits

Under the hood the plugin uses [WyriHaximus' HtmlCompress](https://github.com/WyriHaximus/HtmlCompress).

## License

The plugin is licensed under the MIT license. See `LICENSE` for more information.
