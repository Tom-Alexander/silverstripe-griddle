import ActionIcon from './ActionIcon';
import React, {Component} from 'react';

export default class ColumnLink extends Component {

  editRow(id) {
    console.log('EDIT: ' + id);
  }

  deleteRow(id) {
    console.log('DELETE: ' + id);
  }

  render() {
    const {canEdit, canDelete, ID} = this.props.rowData;
    return(
      <div>
        {canEdit ? <a onClick={this.editRow.bind(this, ID)}><ActionIcon type="edit"/></a> : null}
        {canDelete ? <a onClick={this.deleteRow.bind(this, ID)}><ActionIcon type="removeLink"/></a> : null}
      </div>
    );
  }
}
