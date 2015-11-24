<?php

/**
 * Class GriddleFieldSource
 *
 */
class GriddleFieldSource extends Object
{

    private $list;

    private $columns = array();

    private $columnMappings = array();

    /**
     * @param SS_List $list
     */
    public function __construct(SS_List $list = null)
    {
        $this->list = $list;
        $this->addColumnMapping('ID', 'ID');
        $fields = singleton($this->list->dataClass())->summaryFields();
        foreach ($fields as $title => $field) {
            $this->addColumn($title);
            $this->addColumnMapping($title, $field);
        }
    }

    /**
     * @return SS_List
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @return array
     */
    public function getColumnMappings()
    {
        return $this->columnMappings;
    }

    /**
     * Adds a column to the GridFieldSource object. This will be visible as a
     * sortable column from the rendered GridField. If there is no
     * corresponding columnMapping, an empty value will be
     * rendered in the cell.
     *
     * @param null $column
     * @return array
     */
    public function addColumn($column)
    {
        array_push($this->columns, $column);
        return $this->columns;
    }

    /**
     * Adds a mapping to the column. The value return from the map will be
     * inserted as the value of the cell for the $column.
     * @param null $column
     * @return array
     */
    public function addColumnMapping($column, $map)
    {
        $this->columnMappings[$column] = $map;
        return $this->columnMappings;
    }

    /**
     * @param $record
     * @param $map
     * @return mixed
     */
    protected function getValue($record, $map)
    {
        if (is_string($map)) {
            return $record->{$map};
        }

        if (is_callable($map)) {
            return $map($record, $this->list);
        }
    }

    /**
     * @param $sort
     * @param $sortAscending
     * @param $start
     * @param $length
     * @return array
     */
    public function serialize($sort, $sortAscending, $start, $length)
    {

        $list = $this->list;
        $start = intval($start);
        $length = intval($length);
        $sortAscending = $sortAscending == 'true';
        $direction = $sortAscending ? 'ASC' : 'DESC';

        $results = array(
            'data' => array(),
            'start' => $start,
            'length' => $length
        );

        if (in_array($sort, $this->columns)) {
            if ($this->list->canSortBy($sort)) {
                $list = $list->sort($sort, $direction);
                $results['sort'] = $sort;
                $results['ascending'] = $sortAscending;
            }
        }

        $paginatedList = new PaginatedList($list, array(
            'start' => $start
        ));

        $paginatedList->setPageLength($length);
        $results['total'] = $paginatedList->getTotalItems();

        foreach ($paginatedList as $key => $record) {
            foreach ($this->getColumnMappings() as $name => $map) {
                $results['data'][$key][$name] = $this->getValue(
                    $record,
                    $map
                );
            }
        }

        return $results;

    }
}
