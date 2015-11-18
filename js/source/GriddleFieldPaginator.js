import React, {Component, PropTypes} from 'react';
import '../../css/less/GriddleFieldPaginator.less';

export default class GriddleFieldPaginator extends Component {

  static propTypes = {
    maxPage: PropTypes.number,
    currentPage: PropTypes.number,
    next: PropTypes.func.isRequired,
    previous: PropTypes.func.isRequired
  }

  static defaultProps = {
    maxPage: 0,
    currentPage: 0,
  }

  last() {
    this.props.setPage(this.props.maxPage);
  }

  previous() {
    if(this.props.currentPage > 0) {
      this.props.setPage(this.props.currentPage - 1);
    }
  }

  next() {
    if(this.props.currentPage < this.props.maxPage) {
      this.props.setPage(this.props.currentPage + 1);
    }
  }

  first() {
    this.props.setPage(0);
  }

  setPage(e) {
    this.props.setPage(parseInt(e.target.value) - 1);
  }

  render() {
    const hasPrevious = this.props.currentPage > 0 ? '' : '--disabled';
    const hasNext = this.props.currentPage < this.props.maxPage ? '' : '--disabled';
    return (
      <div className="GriddleFieldPaginator">
        <a className={`GriddleFieldPaginator__First${hasPrevious}`}
          onClick={this.first.bind(this)}></a>
        <a className={`GriddleFieldPaginator__Previous${hasPrevious}`}
          onClick={this.previous.bind(this)}></a>
        <div className="GriddleFieldPaginator__Text">
          <span>Page</span>
          <input className="GriddleFieldPaginator__PageSelector"
            value={this.props.currentPage + 1}
            onChange={this.setPage.bind(this)}/>
          <span>of {this.props.maxPage + 1}</span>
        </div>
        <a className={`GriddleFieldPaginator__Next${hasNext}`}
          onClick={this.next.bind(this)}></a>
        <a className={`GriddleFieldPaginator__Last${hasNext}`}
          onClick={this.last.bind(this)}></a>
      </div>
    );
  }
}
