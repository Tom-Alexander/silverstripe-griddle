import React, {Component} from 'react';

export default class ActionButton extends Component {
  render() {

    return (
      <a href="#"
      className="action action-detail ss-ui-action-constructive ss-ui-button ui-button ui-widget ui-state-default ui-corner-all new new-link ui-button-text-icon-primary"
      role="button"
      aria-disabled="false">
        <span className="ui-button-icon-primary ui-icon btn-icon-add"></span>
        {
          this.props.text ?
          <span className="ui-button-text">{this.props.text}</span>
          : null
        }
      </a>
    );
  }
}
