<?php

return [
    'items' => [
        [
            'text' => 'Course Section',
            'route' => 'courses.index',
            'icon' => 'fas fa-book mr-3 w-5 text-center',
            'active_on' => ['home', 'courses.*'],
        ],
        [
            'text' => 'Level Section',
            'route' => 'levels.index',
            'icon' => 'fas fa-tachometer-alt mr-3 w-5 text-center',
            'active_on' => ['levels.*'],
        ],
        [
            'text' => 'Category Section',
            'route' => 'categories.index',
            'icon' => 'fas fa-chart-bar mr-3 w-5 text-center',
            'active_on' => ['categories.*'],
        ],
    ],
];
