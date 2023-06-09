<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('welcome', function (BreadcrumbTrail $trail) {
    $trail->push('Welcome', route('welcome'));
});

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('admin.users', function (BreadcrumbTrail $trail) {
    $trail->push('User', route('admin.users'));
});

Breadcrumbs::for('admin.roles', function (BreadcrumbTrail $trail) {
    $trail->push('Roles', route('admin.roles'));
});

Breadcrumbs::for('admin.roles_permissions', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('admin.roles');
    $trail->push($role->name);
    $trail->push('Permissions', route('admin.roles_permissions',$role));
});

Breadcrumbs::for('profile.show', function (BreadcrumbTrail $trail) {
    $trail->push('Profile', route('profile.show'));
});
