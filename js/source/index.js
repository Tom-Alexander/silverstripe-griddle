import React from 'react';
import {render} from 'react-dom';
import GriddleField from './GriddleField';
import {createFetchGridData} from './griddleFieldService';
import GriddleRelationEditor from './GriddleRelationEditor';

(function ($) {
  $.entwine('ss', function ($) {

    $('.GriddleField_holder').entwine({
      onmatch: function () {
        const $element = $(this);
        const columns = JSON.parse($element.attr('data-columns'));
        const local = $element.attr('data-local');
        const link = $element.attr('data-link');
        const name = $element.attr('data-name');
        const fetcher = createFetchGridData(local, link, name);
        const initialData = JSON.parse(JSON.parse($element.attr('data-initial')));
        render(
          <GriddleField
            columns={columns}
            fetcher={fetcher}
            localStorageID={local}
            initialData={initialData} />,
          $element[0]
        );
      }
    });

    $('.GriddleRelationEditor_holder').entwine({
      onmatch: function () {
        const $element = $(this);
        const columns = JSON.parse($element.attr('data-columns'));
        const initialData = JSON.parse(JSON.parse($element.attr('data-initial')));
        const local = $element.attr('data-local');
        const link = $element.attr('data-link');
        const name = $element.attr('data-name');
        const fetcher = createFetchGridData(local, link, name);
        render(
          <GriddleRelationEditor
            columns={columns}
            fetcher={fetcher}
            localStorageID={local}
            initialData={initialData} />,
          $element[0]
        );
      }
    });

  });
})(jQuery);
