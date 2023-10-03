<?php

class model {

    public $query = '';
    protected $table = '';

    /**
     * Adds a limit parameter to the query.
     */
    public function limit(int $iLimit): model
    {
        $this->query .= ' LIMIT ' . $iLimit;

        return $this;
    }

    /**
     * Adds an order by parameter to the query
     */
    public function orderBy(string $sColumn, string $sOrderBy = 'DESC'): model
    {
        $this->query .= ' ORDER BY ' . $sColumn . ' ' . $sOrderBy;

        return $this;
    }

    /**
     * Adds a where query but include a parameter for WhereLike
     */
    public function where(string $sColumn, string $sValue, $sParameter = '='): model
    {
        $this->query .= ' WHERE ' . $sColumn . ' ' . $sParameter . ' "' . $sValue . '"'; 
        
        return $this;
    }

    /**
     * Joins a table based on given keys
     */
    public function join(string $sTable, string $sPrimaryKey, string $sForeignKey): model
    {
        $this->query .= ' JOIN ' . $sTable . ' ON ' . $sTable.'.'.$sPrimaryKey . '=' . $this->table.'.'.$sForeignKey;

        return $this;
    }

    public function groupBy(string $sColumn): model
    {
        $this->query .= ' GROUP BY ' . $sColumn;

        return $this;
    }
}

?>