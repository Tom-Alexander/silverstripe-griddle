import React, {Component} from 'react';
import Select from 'react-select';
import ActionButton from './ActionButton';
import 'react-select/less/select.less';
import '../../css/less/RelationSearchField.less';

export default class RelationSearchField extends Component {

findRelated() {
  return new Promise((resolve, reject) => {
    jQuery.get(this.props.handler)
      .done((data) => {
        const values = data.data.map(item => ({ value: item.ID, label: item.ID + '' }));
        resolve({options: values});
      }).fail(reject);
  });
}

  render() {
    return (
      <div className="RelationSearchField">
        <Select placeholder={`Find ${this.props.data_class} by ID:Starts With`} asyncOptions={this.findRelated.bind(this)}/>
        <ActionButton type="secondary" text="Link Existing"/>
      </div>
    );
  }
}
