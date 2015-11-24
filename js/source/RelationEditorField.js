import React, {Component} from 'react';
import GriddleField from './GriddleField';
import ActionButton from './ActionButton';
import ColumnLink from './ColumnLink';
import {createFetchGridData} from './griddleFieldService';
import RelationSearchField from './RelationSearchField';
import '../../css/less/GriddleRelationEditor.less';

export default class RelationEditorField extends Component {

  render() {
    return (
      <div className="GriddleRelationEditor">
        <div className="GriddleRelationEditor__Actions">
          <div className="GriddleRelationEditor__ActionContainer--left">
            <ActionButton text={`Add ${this.props.data_class}`}/>
          </div>
          <div className="GriddleRelationEditor__ActionContainer--right">
            <RelationSearchField handler={this.props.handler} data_class={this.props.data_class}/>
          </div>
        </div>
        <GriddleField {...this.props}
        columnMetadata={[{
          locked: true,
          columnName: 'Action',
          cssClassName: 'Action',
          customComponent: ColumnLink
        }]}
          fetcher={createFetchGridData(
            this.props.field_id,
            `${this.props.handler}/GriddleField`,
            this.props.field_name)}/>
      </div>
    );
  }
}
