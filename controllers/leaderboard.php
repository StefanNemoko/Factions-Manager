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
    public function index() {
        $aParams = [];
        $oPhxclients = new Phxclients;

        // This are only all time records, we need to start recording monthly records aswell.
        $aParams['aLeaders'] = $oPhxclients->join('phxstats_users', 'uid', 'playerid')->groupBy('phxstats_users.uid')->orderBy('totalMoney')->limit(10)->getResult();
        $aParams['aSections'] = array_keys(get_object_vars($aParams['aLeaders'][0]));

        $aParams['aMonthlyLeaders'] = $oPhxclients->join('phxstats_users', 'uid', 'playerid')->groupBy('phxstats_users.uid')->orderBy('totalMoney')->limit(10)->getResult();

        Controller::buildPage(array(ROOT . 'views/navbar', ROOT . 'views/leaderboard/index'), $aParams);
    }
}
?>
