import React, {Component} from 'react';
import '../../css/less/ActionIcon.less';

export default class ActionIcon extends Component {

  static defaultProps = {
    type: 'add'
  };

  render() {
    return (
      <span className={`ActionIcon__${this.props.type}`}/>
    );
  }
}
