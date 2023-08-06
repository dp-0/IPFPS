<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
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
Breadcrumbs::for('admin.user_activity', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users');
    $trail->push('Activity Logs', route('admin.user_activity'));
});

Breadcrumbs::for('admin.roles_permissions', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('admin.roles');
    $trail->push($role->name);
    $trail->push('Permissions', route('admin.roles_permissions',$role));
});

Breadcrumbs::for('profile.show', function (BreadcrumbTrail $trail) {
    $trail->push('Profile', route('profile.show'));
});
//Fir Management
Breadcrumbs::for('admin.fir.complainants', function (BreadcrumbTrail $trail) {
    $trail->push('Complainants', route('admin.fir.complainants'));
});
Breadcrumbs::for('admin.fir.incident-type', function (BreadcrumbTrail $trail) {
    $trail->push('Incident Type', route('admin.fir.incident-type'));
});
Breadcrumbs::for('admin.fir.case-priority', function (BreadcrumbTrail $trail) {
    $trail->push('Case Priority', route('admin.fir.case-priority'));
});
Breadcrumbs::for('admin.fir.fir-status', function (BreadcrumbTrail $trail) {
    $trail->push('Fir Status', route('admin.fir.fir-status'));
});
Breadcrumbs::for('admin.fir.fir-list', function (BreadcrumbTrail $trail) {
    $trail->push('Fir', route('admin.fir.fir-list'));
});
Breadcrumbs::for('admin.fir.new', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.fir.fir-list');
    $trail->push('New', route('admin.fir.new'));
});
Breadcrumbs::for('admin.fir.complain', function (BreadcrumbTrail $trail) {
    $trail->push('Complain', route('admin.fir.complain'));
});
Breadcrumbs::for('admin.fir.complain.new', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.fir.complain');
    $trail->push('New', route('admin.fir.complain.new'));
});
Breadcrumbs::for('admin.fir.complain.view', function (BreadcrumbTrail $trail, $complain) {
    $trail->parent('admin.fir.complain');
    $trail->push($complain->getComplainBy->name);
    $trail->push($complain->id, route('admin.fir.complain.view',$complain->id));
});
Breadcrumbs::for('admin.fir.view', function (BreadcrumbTrail $trail, $fir) {
    $trail->parent('admin.fir.fir-list');
    $trail->push($fir->getComplainBy->name,route('admin.fir.view',$fir->id));
});
Breadcrumbs::for('admin.fir.suspect.profile', function (BreadcrumbTrail $trail, $suspect) {
    $trail->parent('admin.fir.fir-list');
    $trail->push('Suspect');
    $trail->push($suspect->name,route('admin.fir.suspect.profile',$suspect->id));
});
Breadcrumbs::for('admin.fir.evidence.add', function (BreadcrumbTrail $trail, $fir) {
    $trail->parent('admin.fir.view',$fir);
    $trail->push('Evidence');
    $trail->push('New',route('admin.fir.evidence.add',$fir->id));
});
