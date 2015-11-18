<?php

class GriddleField extends FormField
{

    private $source;

    private $length = 2;

    private $initialStart = 0;

    private $initialSort = 'Answer';

    private $initialAscending = 'true';

    /**
     *
     * @var array
     */
    private static $allowed_actions = array(
        'index'
    );

    /**
     * @param string $name
     * @param null $title
     * @param SS_List $list
     */
    public function __construct($name, $title = null, SS_List $list = null)
    {
        parent::__construct($name, $title, null);
        $this->name = $name;
        $this->source = new GriddleFieldSource($list);
    }

    public function injectRequirements()
    {
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery-entwine/dist/jquery.entwine-dist.js');
        Requirements::javascript(GRIDDLE_FIELD_DIR . '/js/GriddleField.bundle.js');
        Requirements::css(GRIDDLE_FIELD_DIR . '/css/GriddleField.css');
    }

    public function index($request)
    {
        $response = new SS_HTTPResponse();
        $response->setBody(
            $this->source->serialize(
                self::get_default($request, 'sort', null),
                self::get_default($request, 'ascending', $this->initialAscending),
                self::get_default($request, 'start', $this->initialStart),
                self::get_default($request, 'length', $this->length)
            ));
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }

    public function getSource()
    {
        return $this->source;
    }

    protected static function get_default(SS_HTTPRequest $request, $var, $default)
    {

        if($value = $request->getVar($var)) {
            return $value;
        }

        return $default;

    }

    public function getColumns()
    {
        return Convert::raw2xml(
            json_encode(array_values($this->source->getColumns()))
        );
    }

    public function getInitialData()
    {
        return Convert::raw2xml(json_encode(
            $this->source->serialize(
                $this->initialSort,
                $this->initialAscending,
                $this->initialStart,
                $this->length
            )
        ));
    }

    public function Field($properties = array())
    {
        $this->injectRequirements();
        return $this->customise(array(
            'Columns' => $this->getColumns(),
            'InitialData' =>  $this->getInitialData(),
            'LocalStorageID' => hash('md5', sprintf(
                '%s/%s',
                $this->Link(),
                $this->name
            ))))->renderWith(array('templates/GriddleField'));
    }


}
