<?php

Breadcrumbs::for('', function ($trail) {
    $trail->push('Home', route('home'));
});