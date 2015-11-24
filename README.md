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

## License

The MIT License (MIT)

Copyright (c) 2015 Tom Alexander

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

## Contributing

### Code guidelines

This project follows the standards defined in:

* [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
* [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
* [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
