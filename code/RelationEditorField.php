<?php

class RelationEditorField extends FormField
{

    private $grid;

    private static $allowed_actions = array(
        'index',
        'GriddleField'
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
        $this->grid = new GriddleField($name, $title, $list);
        $source = $this->grid->getSource();
        $source->addColumn('Action');
        $source->addColumnMapping('Action', function($record) {
            return json_encode(array(
                'canEdit' => $record->canEdit(Member::currentUser()),
                'canDelete' => $record->canDelete(Member::currentUser()),
            ));
        });
    }

    /**
     *
     * @param SS_HTTPRequest $request
     * @return SS_HTTPResponse
     */
    public function index(SS_HTTPRequest $request) {
        $response = new SS_HTTPResponse();
        return $response;
    }

    /**
     * Send the request to the GriddleField
     * @param SS_HTTPRequest $request
     * @return array|RequestHandler|SS_HTTPResponse|string
     */
    public function GriddleField(SS_HTTPRequest $request) {
        return $this->grid->handleRequest(
            $request,
            $this->model
        );
    }

    public function removeRelationAction()
    {
    }


    public function createRelationAction()
    {

    }

    public function searchRelationAction()
    {

    }

    public function Field($properties = array())
    {
        $this->grid->injectRequirements();
        return $this
            ->customise(array(
                'Columns' => $this->grid->getColumns(),
                'InitialData' =>  $this->grid->getInitialData(),
                'LocalStorageID' => hash('md5', sprintf(
                    '%s/%s',
                    $this->Link(),
                    $this->name
                ))))->renderWith(array('templates/GriddleRelationEditorField'));
    }


}
