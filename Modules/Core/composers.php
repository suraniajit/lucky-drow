<?php
view()->composer('theme::layouts.frontend.masterhome', \Modules\Core\Composers\AssetsViewComposer::class);
view()->composer('theme::layouts.frontend.master', \Modules\Core\Composers\AssetsViewComposer::class);
view()->composer('theme::layouts.backend.master', \Modules\Core\Composers\AssetsViewComposer::class);
view()->composer('theme::layouts.backend.partials.main_sidebar', \Modules\Core\Composers\MenuComposer::class);
view()->composer('theme::layouts.backend.partials.staradmin.sidebar', \Modules\Core\Composers\MenuComposer::class);
view()->composer('theme::layouts.backend.partials.vertical_sidebar', \Modules\Core\Composers\MenuComposer::class);
view()->composer('theme::layouts.backend.partials.mobile_header', \Modules\Core\Composers\MenuComposer::class);
