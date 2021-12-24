<?php

namespace Grav\Plugin;

use Grav\Common\Plugin;
use Composer\Autoload\ClassLoader;
use WyriHaximus\HtmlCompress\Factory;

/**
 * Class HTMLMinifierPlugin
 * @package Grav\Plugin
 */
class HTMLMinifierPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => [
                ['autoload', 100000],
                ['onPluginsInitialized', 0]
            ]
        ];
    }

    /**
     * Composer autoload
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized(): void
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main events we are interested in
        $this->enable([
            'onOutputGenerated' => ['onOutputGenerated', 0]
        ]);
    }

    /**
     * On Page Content Raw Hook
     */
    public function onOutputGenerated()
    {
        // Check if the page type is HTML
        if ($this->grav['page']->templateFormat() !== 'html') {
            return;
        }

        $compressedHtml = $this->compressHtml();

        // If cache is disabled, return compressed HTML
        if (!$this->config['plugins.html-minifier.cache']) {
            $this->grav->output = $compressedHtml;
            return;
        }

        // Check if page exists in cache
        $cache = $this->grav['cache'];
        $cacheId = md5('html-minifier' . $this->grav['page']->id());
        $cachedHtml = $cache->fetch($cacheId);

        // Yes, return cached HTML
        if ($cachedHtml) {
            $this->grav->output = $cachedHtml;
            return;
        }

        // No, add it to cache and return it
        $cache->save($cacheId, $compressedHtml);
        $this->grav->output = $compressedHtml;
    }

    /**
     * Compress HTML output
     *
     * @return string compressed HTML
     */
    private function compressHtml()
    {
        $html = $this->grav->output;
        $mode = $this->config['plugins.html-minifier.mode'];

        if ($mode === 'smallest') {
            return Factory::constructSmallest()->compress($html);
        } elseif ($mode === 'fastest') {
            return Factory::constructFastest()->compress($html);
        }

        return Factory::construct()->compress($html);
    }
}
