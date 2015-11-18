import React, {Component} from 'react';

export default class GriddleFieldActionableColumn extends Component {
  render() {
    return (
      <div className="GriddleFieldActionableColumn">
        <a>href={this.props.data}</a>
      </div>
    );
  }
}
