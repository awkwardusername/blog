<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        $app['cache']->setDefaultDriver('array');

        $app->setLocale('en');
        $app->setPluginsPath(base_path().'/tests/fixtures/plugins');
        $app->setThemesPath(base_path().'/tests/fixtures/themes');

        return $app;
    }

}
