import React, {Component} from 'react';
import Select from 'react-select';
import ActionButton from './ActionButton';
import 'react-select/less/select.less';
import '../../css/less/RelationSearchField.less';

export default class RelationSearchField extends Component {
  render() {
    return (
      <div className="RelationSearchField">
        <Select placeholder="Find by ID:Starts With" asyncOptions={() => {return ['#1']}}/>
        <ActionButton text="Link Existing"/>
      </div>
    );
  }
}
