<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Core';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'core';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->commands([
            \Modules\Core\Console\CronMakeCommand::class,
            \Modules\Core\Console\CustomEntityCommand::class,
            \Modules\Core\Console\CustomRepositoryCommand::class,
            \Modules\Core\Console\CustomEloquentCommand::class,
            \Modules\Core\Console\CustomCacheCommand::class,
            \Modules\Core\Console\CustomLangCommand::class,
            \Modules\Core\Console\CustomCreateRequestCommand::class,
            \Modules\Core\Console\CustomUpdateRequestCommand::class,
            \Modules\Core\Console\CustomControllerCommand::class,
            \Modules\Core\Console\CustomBladeIndexCommand::class,
            \Modules\Core\Console\CustomBladeCreateCommand::class,
            \Modules\Core\Console\CustomBladeEditCommand::class,
            \Modules\Core\Console\CustomBladeGridCommand::class,
            \Modules\Core\Console\CustomEmptyEloquentCommand::class,
            \Modules\Core\Console\CustomEmptyCacheCommand::class,
            \Modules\Core\Console\CustomTranslatableEntityCommand::class,
            \Modules\Core\Console\CustomTranslatableControllerCommand::class,
            \Modules\Core\Console\CustomTranslatableCreateRequestCommand::class,
            \Modules\Core\Console\CustomTranslatableUpdateRequestCommand::class,
            \Modules\Core\Console\CustomTranslatableBladeCreateCommand::class,
            \Modules\Core\Console\CustomTranslatableBladeCreateTranslatableCommand::class,
            \Modules\Core\Console\CustomTranslatableBladeEditCommand::class,
            \Modules\Core\Console\CustomTranslatableBladeEditTranslatableCommand::class,

        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
