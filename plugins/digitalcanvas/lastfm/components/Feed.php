<?php namespace DigitalCanvas\LastFM\Components;

use Cms\Classes\ComponentBase;

class Feed extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'LastFM Last Played',
            'description' => 'Pull your last played songs from the lastFM.'
        ];
    }

    public function defineProperties()
    {
        return [
            'user_name' => [
                'title'             => 'LastFM User Name',
                'description'       => 'What is your LastFM User Name?',
                'default'           => 'username',
                'type'              => 'string',
                'validationPattern' => '^(?=\s*\S).*$',
                'validationMessage' => 'The "User Name" property is required.'
            ],
            'limit' => [
                'title'             => 'Song Limit',
                'description'       => 'How many songs do you want to show?',
                'default'           => 10,
                'type'              => 'string',
                'validationPattern' => '^[0-9]*$',
                'validationMessage' => 'The "Song Limit" property can contain only numeric symbols.'
            ],
        ];
    }

    public function onRun()
    {
        $count = 1;
        $user_name = $this->propertyOrParam('user_name');
        $limit = $this->propertyOrParam('limit');
        $rss = 'http://ws.audioscrobbler.com/1.0/user/'.$user_name.'/recenttracks.xml';
        $doc = new \DOMDocument();
        $doc->load($rss);
        $songFeed = array();
        foreach ($doc->getElementsByTagName('track') as $track) {
            $songRSS = array (
                    'artist' => $track->getElementsByTagName('artist')->item(0)->nodeValue,
                    'name' => $track->getElementsByTagName('name')->item(0)->nodeValue,
                    'url' => $track->getElementsByTagName('url')->item(0)->nodeValue,
                    );
            array_push($songFeed, $songRSS);
            if ($count++ == $limit) break;
        }
        $this->page['feeds'] = $songFeed;
    }

}