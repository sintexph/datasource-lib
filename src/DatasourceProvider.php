<?php

namespace SintexDatasource;

use Illuminate\Support\ServiceProvider;

class DatasourceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishConfig();
    }

    private function publishConfig()
    {
        $this->publishes([
            __DIR__.'/config' => base_path('config'),
        ]);
    }
}
