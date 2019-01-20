<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'NaNFL');

// Project repository
set('repository', 'git@github.com:incrediblecrayon/nanfl.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', [
    'database/database.sqlite'
]);
add('shared_dirs', []);

// Writable dirs by web server
//set('writable_mode','chgrp');
//set('http_group','www-data');
//set('writable_use_sudo', true);

add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts
host('production')
    ->stage('production')
    ->hostname('nanfl.nowvoid.com')
    ->user('joel')
    ->identityFile('~/.ssh/id_rsa')
    ->forwardAgent(true)
    ->set('deploy_path', '/var/www/nanfl.nowvoid.com')
    ->set('git_recursive', false);
    
// Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});


desc('Bundle JS/CSS');
task('bundlejs', function () {

//    if(get('stage') === 'development')
//    {
//        runLocally("npm run dev");
//    }else{
//        runLocally("npm run production");
//    }
//
//    //Upload Bundled JS Files
//    upload('public/js/*', '{{release_path}}/public/js/');
//    upload('public/css/*', '{{release_path}}/public/css/');
//    upload('public/img/*', '{{release_path}}/public/img/');
//    upload('public/images/*', '{{release_path}}/public/images/');
//    upload('public/vendors/*', '{{release_path}}/public/vendors/');
//    upload('public/fonts/*', '{{release_path}}/public/fonts/');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
//before('deploy:symlink', 'artisan:migrate');

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'bundlejs',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:cache:clear',
    'artisan:config:cache',
    'artisan:optimize',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'artisan:queue:restart'
]);
