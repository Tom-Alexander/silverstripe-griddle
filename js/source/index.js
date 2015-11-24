import React, {createElement} from 'react';
import {render} from 'react-dom';
import GriddleField from './GriddleField';
import {createFetchGridData} from './griddleFieldService';
import RelationEditorField from './RelationEditorField';

(function (window) {
  window.createReactField = function (name, id, handler, props) {
    const fetcher = createFetchGridData(id, handler, name);
    const componentProps = {...props, fetcher, handler};
    const component = name === 'GriddleField' ? <GriddleField {...componentProps}/>
      : <RelationEditorField {...componentProps}/>;
    render(
      component,
      document.getElementById(id).parentNode
    );
  }
})(window);
