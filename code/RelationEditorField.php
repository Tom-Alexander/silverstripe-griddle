<?php

class RelationEditorField extends ReactFormField
{

    /**
     * @var GriddleField
     */
    protected $grid;

    /**
     * @var array
     */
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
        $source = $this->getSource();
        $source->addColumn('Action');

        $source->addColumnMapping('canEdit', function ($record) {
            return $record->canEdit(Member::currentUser());
        });

        $source->addColumnMapping('canDelete', function ($record) {
            return $record->canEdit(Member::currentUser());
        });

        $source->addColumnMapping('Action', function () {
            return true;
        });
    }

    /**
     * Returns the SS_List attached to the associated GriddleFieldSource
     * @return SS_List
     */
    public function getList()
    {
        return $this->getSource()->getList();
    }

    /**
     * Returns the GriddleFieldSource
     * @return GriddleFieldSource
     */
    public function getSource()
    {
        return $this->getGrid()->getSource();
    }

    /**
     * Returns the GriddleField
     * @return GriddleField
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * Returns the serialized data list after the requested relation has
     * been deleted
     * @param SS_HTTPRequest $request
     * @return SS_HTTPResponse
     */
    public function handleDeleteAction(SS_HTTPRequest $request)
    {
        $list = $this->getList();
        $dataClass = $list->dataClass();
        $object = DataObject::get($dataClass, $request->postVar('ID'));
        $list->remove($object);
        return $this->handleGetAction($request);
    }

    /**
     * Returns the serialized data list after the requested relation has
     * been created
     * @param SS_HTTPRequest $request
     * @return SS_HTTPResponse
     */
    public function handlePostAction(SS_HTTPRequest $request)
    {
        $list = $this->getList();
        $dataClass = $list->dataClass();
        $object = DataObject::get($dataClass, $request->postVar('ID'));
        $list->add($object);
        return $this->handleGetAction($request);
    }

    /**
     * Returns the serialized data list form the relation search
     * @param SS_HTTPRequest $request
     * @return SS_HTTPResponse
     */
    public function handleGetAction(SS_HTTPRequest $request)
    {
        $dataClass = $this->getList()->dataClass();
        $list = DataObject::get($dataClass);
        $source = new GriddleFieldSource($list);
        $response = new SS_HTTPResponse();
        $body = json_encode($source->serialize('ID', true, 0, 10));
        $response->setBody($body);
        return $response;
    }

    /**
     * Returns the initial properties required to instantiate the
     * RelationEditorField component
     * @return SS_HTTPResponse
     */
    public function getInitialProperties()
    {
        return array_merge($this->getGrid()->getInitialProperties(), array(
            'data_class' => $this->getList()->dataClass()
        ));
    }

    /**
     * Send the request to the GriddleField
     * @param SS_HTTPRequest $request
     * @return SS_HTTPResponse
     */
    public function GriddleField(SS_HTTPRequest $request)
    {
        $response = $this->getGrid()->handleGetAction($request);
        $response->addHeader('Content-Type', 'application/json');
        return $response;
    }
}
