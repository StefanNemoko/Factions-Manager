<?php

class leaderboard extends Controller {    
    public function __construct() {
        parent::__construct(false);
        
        Controller::$currentPage = 'Dashboard';
        Controller::$subPage = 'Leaderboard';
        Controller::addCrumb(array("Leaderboard", "leaderboard/"));
    }

    /**
     * Return index page with all the leaders
     */
    public function index () {
        $aParams = [];

        $aLeaders = [];

        $oPhxclients = new Phxclients;
        //TODO:: add a join query for table `phxstats_users` so we can see the kills aswell.
        // This are only all time records, we need to start recording monthly records aswell.
        $aParams['aLeaders'] = $oPhxclients->orderBy('cash')->limit(10)->getResult();
        $aParams['aSections'] = array_keys(get_object_vars($aParams['aLeaders'][0]));

        Controller::buildPage(array(ROOT . 'views/navbar', ROOT . 'views/leaderboard/index'), $aParams);
    }
}
?>
