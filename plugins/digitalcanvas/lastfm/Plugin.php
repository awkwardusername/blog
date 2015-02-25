<?php namespace DigitalCanvas\LastFM;

use System\Classes\PluginBase;

/**
 * LastFM Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'LastFM',
            'description' => 'Parse your LastFM RSS feed and display it on your site!',
            'author'      => 'DigitalCanvas',
            'icon'        => 'icon-music'
        ];
    }

    public function registerComponents()
    {
        return [
            'DigitalCanvas\LastFM\Components\Feed' => 'LastfmFeed',
        ];
    }
}
