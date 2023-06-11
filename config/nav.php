<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
[
    'icon' => 'nav-icon fas fa-tachometer-alt',
    'route' => 'dashboard.dashboard',
    'title' => 'Dashboard',
    'active' => 'dashboard.dashboard',
],
[
    'icon' => 'fas fa-tags nav-icon',
    'route' => 'dashboard.categories.index',
    'title' => 'Categories',
    'active' => 'dashboard.categories.*',
    'badge' => 'new'
]


// [
//     'icon' => 'fas fa-tags nav-icon',
//     'route' => 'dashboard.categories.index',
//     'title' => 'Categories',
//     'badge' => 'New',
//     'active' => 'dashboard.categories.*',
//     'ability' => 'categories.view',
// ],

];