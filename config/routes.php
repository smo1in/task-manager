<?php
return array(
    '(?m)^tasks/status$' => 'tasks/changeStatus',
    '(?m)^tasks/priority$' => 'tasks/exchangePriority',
    '(?m)^tasks/deadline$' => 'tasks/setDeadline',
    '(?m)^tasks/delete$' => 'tasks/delete',
    '(?m)^tasks/update$' => 'tasks/update',
    '(?m)^tasks/create$' => 'tasks/create',
    '(?m)^tasks$' => 'tasks/index',
    '(?m)^login$' => 'user/login',
    '(?m)^logout$' => 'user/logout',
    '(?m)^getlogin$' => 'user/getLogin',
    '(?m)^reg$' => 'user/registration',
    '(?m)^projects/delete$' => 'projects/delete',
    '(?m)^projects/update$' => 'projects/update',
    '(?m)^projects/create$' => 'projects/create',
    '(?m)^projects$' => 'projects/index',
    '(?m)^template/(\w+)$' => 'index/template/$1',
    '(?m)^start$' => 'index/start',
    '(?m)^index$' => 'index/index',
    '' => 'index/index'
);