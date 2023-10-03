<?php

class Phxclients {

    public $query = '';

    /**
     * Adds a limit parameter to the query.
     */
    public function limit(int $iLimit): Phxclients
    {
        $this->query .= ' LIMIT ' . $iLimit;

        return $this;
    }

    /**
     * Adds an order by parameter to the query
     */
    public function orderBy(string $sColumn, string $sOrderBy = 'DESC'): Phxclients
    {
        $this->query .= ' ORDER BY ' . $sColumn . ' ' . $sOrderBy;

        return $this;
    }

    /**
     * Adds a where query but include a parameter for WhereLike
     */
    public function where(string $sColumn, string $sValue, $sParameter = '='): Phxclients
    {
        $this->query .= ' WHERE ' . $sColumn . ' ' . $sParameter . ' "' . $sValue . '"'; 
        
        return $this;
    }

    public function getResult(): array
    {
        $aHost = [
            DB_HOST_LIFE,
            DB_USER_LIFE,
            DB_PASS_LIFE
        ];

        $this->query = 'SELECT name, playerid, SUM(bankacc + cash) as TotalMoney, prestigeLevel FROM `phxclients` ' . $this->query . ';';
        
        $query = Database::getFactory()->getConnection(DB_NAME_LIFE, $aHost)->prepare($this->query);
        $query->execute();
        $aResult = $query->fetchAll();
        return $aResult;
    }



    public static function getPowers($faction, $target) {
        $query = Database::getFactory()->getConnection(DB_NAME)->prepare("SELECT * FROM powers WHERE (faction = :faction OR faction = '') AND active = 1");
        $query->execute(array(":faction" => $faction));

        if ($query->rowCount() == 0) { return false; }

        $return = array();

        foreach($query->fetchAll() as $power) {
            if (
                ($power->suspended == $target->isSuspended || $power->suspended == 2) && 
                ($power->archived == $target->isArchive || $power->archived == 2) &&
                ($power->blacklisted == $target->isBlacklisted || $power->blacklisted == 2) &&
                (Form::canSubmitForm($power->form))
               ) {
                array_push($return, $power);
            }
        }

        return $return;
    }
}