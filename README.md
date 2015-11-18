# silverstripe-griddlefield
This is an in-complete and experimental replacement for `GridField`. Grid state is persistent
across page reloads.

## Usage
It can be used to render any `SS_List` implementation. Grid components and
configurations have been removed. Data can be extended using
`GriddleFieldSource`. The `RelationEditorField` can be used
as a replacement for `GridFieldConfig_RelationEditor`.

```
 $fields->addFieldToTab(
   'Root.Team',
   RelationEditorField::create(
   	'Team',
   	'Team',
   	$this->TeamMember()
```

## API

### GriddleField

`GriddleField(String $name, String $label, SS_List $list)`

`setSource(GriddleFieldSource $source)`

`getSource()`

### RelationEditorField

`RelationEditorField(String $name, String $label, GriddleField $grid)`

### GriddleFieldSource

You can add and remove columns to the grid source using the following methods.

`addColumn($column)`

`addColumnMapping('My Field', 'MyField')`

`addColumnMapping('MyField', function($record) { return $record->MyField; })`
