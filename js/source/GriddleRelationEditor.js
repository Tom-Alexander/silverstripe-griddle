import React, {Component} from 'react';
import GriddleField from './GriddleField';
import ActionButton from './ActionButton';
import RelationSearchField from './RelationSearchField';
import '../../css/less/GriddleRelationEditor.less';

export default class GriddleRelationEditor extends Component {
  render() {
    return (
      <div className="GriddleRelationEditor">
        <div className="GriddleRelationEditor__Actions">
          <div className="GriddleRelationEditor__ActionContainer--left">
            <ActionButton text="Add Foo"/>
          </div>
          <div className="GriddleRelationEditor__ActionContainer--right">
            <RelationSearchField/>
          </div>
        </div>
        <GriddleField {...this.props}/>
      </div>
    );
  }
}
