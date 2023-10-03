<?php

class Phxclients {

    public $query = '';
    private $table = '`phxclients`';

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

    /**
     * Joins a table based on given keys
     */
    public function join(string $sTable, string $sPrimaryKey, string $sForeignKey): Phxclients
    {
        $this->query .= ' JOIN ' . $sTable . ' ON ' . $sTable.'.'.$sPrimaryKey . '=' . $this->table.'.'.$sForeignKey;

        return $this;
    }

    public function groupBy(string $sColumn): Phxclients
    {
        $this->query .= ' GROUP BY ' . $sColumn;

        return $this;
    }

    public function getResult(): array
    {
        $aHost = [
            DB_HOST_LIFE,
            DB_USER_LIFE,
            DB_PASS_LIFE
        ];

        $this->query = 'SELECT name, playerid, SUM(bankacc + cash) as TotalMoney, prestigeLevel, SUM(phxstats_users.kills) as kills FROM ' . $this->table . ' ' . $this->query . ';';

        $query = Database::getFactory()->getConnection(DB_NAME_LIFE, $aHost)->prepare($this->query);
        $query->execute();
        $aResult = $query->fetchAll();
        return $aResult;
    }
}
