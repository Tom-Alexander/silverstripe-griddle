<?php

/**
 * Class GriddleField
 */
class GriddleField extends ReactFormField
{

    private $source;

    private $length = 2;

    private $initialStart = 0;

    private $initialSort = 'Answer';

    private $initialAscending = 'true';

    /**
     * @param string  $name
     * @param null    $title
     * @param SS_List $list
     */
    public function __construct($name, $title = null, SS_List $list = null)
    {
        parent::__construct($name, $title, null);
        $this->name = $name;
        $this->source = new GriddleFieldSource($list);
    }

    public function handleGetAction(SS_HTTPRequest $request)
    {
        $response = new SS_HTTPResponse();
        $response->setBody(
            json_encode($this->source->serialize(
                self::getDefault($request, 'sort', null),
                self::getDefault($request, 'ascending', $this->initialAscending),
                self::getDefault($request, 'start', $this->initialStart),
                self::getDefault($request, 'length', $this->length)
            ))
        );

        return $response;
    }

    public function getSource()
    {
        return $this->source;
    }

    protected static function getDefault(SS_HTTPRequest $request, $var, $default)
    {

        if ($value = $request->getVar($var)) {
            return $value;
        }

        return $default;

    }

    public function getInitialProperties()
    {
        return array(
            'title' => $this->title,
            'field_name' => $this->name,
            'field_id' => $this->getComponentID,
            'columns' => $this->source->getColumns(),
            'data' => $this->source->serialize(
                $this->initialSort,
                $this->initialAscending,
                $this->initialStart,
                $this->length
            )
        );
    }
}
