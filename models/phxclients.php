<?php

class Phxclients extends model {

    public $query = '';
    protected $table = '`phxclients`';

    public function getResult(): array
    {
        $aHost = [
            DB_HOST_LIFE,
            DB_USER_LIFE,
            DB_PASS_LIFE
        ];

        $this->query = 'SELECT name, playerid, SUM(bankacc + cash) as totalMoney, prestigeLevel, SUM(phxstats_users.kills) as kills FROM ' . $this->table . $this->query . ';';
dd($this->query);
        $query = Database::getFactory()->getConnection(DB_NAME_LIFE, $aHost)->prepare($this->query);
        $query->execute();
        $aResult = $query->fetchAll();
        return $aResult;
    }
}
