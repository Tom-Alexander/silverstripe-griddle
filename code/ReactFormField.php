<?php

/**
 * Class ReactFormField
 * Manages dependencies, rendering and routing required for all forms using react
 */
class ReactFormField extends FormField
{

    /**
     * @var array
     */
    private static $allowed_actions = array('index');

    /**
     * Maps the http method to action handlers. Forces the response to have
     * application/json content type. Unhandled methods will return a 404 response code.
     * @param SS_HTTPRequest $request
     * @return mixed
     * @throws SS_HTTPResponse_Exception
     */
    public function index(SS_HTTPRequest $request)
    {
        $action = ucfirst(strtolower($request->httpMethod()));
        $actionHandler = sprintf('handle%sAction', $action);

        if ($this->hasMethod($actionHandler)) {
            $response = $this->{$actionHandler}($request);
            $response->addHeader('Content-Type', 'application/json');
            return $response;
        }

        throw new  SS_HTTPResponse_Exception(
            json_encode(array(
                'code' => 404,
                'description' => 'The action has not been implemented'
            )),
            404
        );

    }

    /**
     * Returns a hash of the current field name and the RequestHandler link. This will be
     * used as a global identification for LocalStorage
     * @return string
     */
    public function getComponentID()
    {
        return hash('md5', sprintf('%s/%s', $this->Link(), $this->name));
    }

    /**
     * Traverses the class hierarchy to determine the required frontend
     * dependencies required from configuration
     */
    protected function requireDependencies()
    {
        $types = array('javascript', 'css');
        $classes = ClassInfo::subclassesFor(get_class($this));
        foreach ($classes as $class) {
            foreach ($types as $type) {
                $dependencies = Config::inst()->get($class, $type) ?: array();
                foreach ($dependencies as $path) {
                    Requirements::{$type}($path);
                }
            }
        }
    }

    /**
     * Render the react component by calling window.createReactField from the
     * template, this element will be replaced when the component mounts
     * @param array $properties
     * @return HTMLText
     */
    public function Field($properties = array())
    {
        $this->requireDependencies();
        return $this->customise(array(
            'ActionHandler' => $this->Link(),
            'ComponentName' => get_class($this),
            'ComponentProps' => json_encode($this->getInitialProperties())
            ))->renderWith(array('templates/ReactFormField'));
    }
}
