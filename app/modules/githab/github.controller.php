<?php

class GithubController extends \BaseController {

    public static $name = 'github';
    public static $group = 'production';

    public function __construct(){

        $this->module = array(
            'name' => self::$name,
            'group' => self::$group,
            'rest' => self::$group . "/" . self::$name,
            'tpl'  => static::returnTpl(),
            'gtpl' => static::returnTpl(),
        );
        View::share('module', $this->module);
    }

    public static function returnRoutes($prefix = null) {

        $class = __CLASS__;
        Route::get('git-deploy/{git_branch}',$class.'@gitDeployProject');
    }

    public static function returnExtFormElements() {

        return TRUE;
    }

    public static function returnActions() {

        return TRUE;
    }

    public static function returnInfo() {

        return TRUE;
    }

    public function gitDeployProject($git_branch){

        if($this->uri->segment(3) == 'xBh4Wy7Y0Jbdmr97QTogVvMOirn2AOgq'):
            $config['test_mode'] = TRUE;
        else:
            $config['test_mode'] = FALSE;
        endif;
        $config['post_data'] = Input::get('payload');
        $config['git_path'] = '/usr/bin/';
        $config['remote'] = 'origin';
        $config['branch'] = Request::segment(2);
        $config['repository_name'] = 'lessad';
        $config['repository_id'] = 12582611;
        $config['user_group'] = 'www-data';
        $config['user_name'] = 'www-data';
        $config['set_log'] = TRUE;

        $github = new GitHub();
        $github->int($config);
        if(Request::segment(3) == 'test'):
            echo $this->git->testConnect('/usr/bin/ssh -T git@github.com');
        else:
            echo $github->execute('git reset --hard HEAD');
            echo "\n";
            echo $github->pull();
            echo "\n";
            echo $github->setAccessMode();
            echo "\n";
            echo $github->setAccessMode('/diskspace','0777');
            echo $github->setAccessMode('/temporary','0777');
            echo $github->setAccessMode('/application/logs','0777');
        endif;
    }
}