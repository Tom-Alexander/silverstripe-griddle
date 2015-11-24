import React, {Component} from 'react';
import '../../css/less/ActionButton.less';

export default class ActionButton extends Component {

  static defaultProps = {
    type: 'primary',
    onClick: (e) => {e.preventDefault()}
  };

  render() {
    return (
      <a role="button"
        aria-disabled="false"
        onClick={this.props.onClick}
        className={`ActionButton--${this.props.type}`}>
          <span className="ActionButton__Text">{this.props.text}</span>
      </a>
    );
  }
}
