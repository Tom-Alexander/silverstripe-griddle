import Griddle from 'griddle-react';
import React, {Component} from 'react';
import GriddleFieldPaginator from './GriddleFieldPaginator';
import '../../css/less/GriddleField.less';

export default class GriddleField extends Component {

  static defaultProps = {
    columnMeta: []
  };

  constructor(props) {
    super(props);
    // const local = window.localStorage[props.localStorageID];
    // const parsedLocal = JSON.parse(local);
    // const initialData = {...props.initialData, ...parsedLocal};
    const {data, start, sort, length, total, ascending} = this.props.data;

    this.state = {
      results: data,
      currentPage: start,
      maxPages: length - 1,
      externalSortColumn: sort,
      externalResultsPerPage: length,
      externalSortAscending: ascending
    };
  }

  getExternalData(...args) {
    this.props.fetcher(...args).then(response => {
      const {data, start, sort, length, total, ascending} = response;
      this.setState({
        results: data,
        currentPage: start,
        maxPages: length - 1,
        externalSortColumn: sort,
        externalResultsPerPage: length,
        externalSortAscending: ascending
      });
    });
  }

  setPage(start) {
    this.getExternalData(
      start,
      this.state.externalResultsPerPage,
      this.state.externalSortColumn,
      this.state.externalSortAscending
    );
  }

  setFilter(filter) {}
  sortData(sort, sortAscending, data) {}

  changeSort(sort, ascending) {
    this.getExternalData(
      this.state.currentPage,
      this.state.externalResultsPerPage,
      sort,
      ascending
    );
  }

  setPageSize(size) {
    this.getExternalData(
      this.state.currentPage,
      size,
      this.state.externalSortColumn,
      this.state.externalSortAscending
    );
  }

  render() {
    return (
      <div className="GriddleField">
        <div className="GriddleField__Title"><h2>{this.props.title}</h2></div>
        <Griddle
          useExternal={true}
          useGriddleStyles={false}
          columns={this.props.columns}
          results={this.state.results}
          useCustomPagerComponent={true}
          customPagerComponent={GriddleFieldPaginator}
          sortAscendingComponent={<span className="GriddleField__Ascending"/>}
          sortDescendingComponent={<span className="GriddleField__Descending"/>}
          externalMaxPage={this.state.maxPages}
          externalSetPage={this.setPage.bind(this)}
          externalCurrentPage={this.state.currentPage}
          externalSetFilter={this.setFilter.bind(this)}
          externalChangeSort={this.changeSort.bind(this)}
          externalSetPageSize={this.setPageSize.bind(this)}
          resultsPerPage={this.state.externalResultsPerPage}
          externalSortColumn={this.state.externalSortColumn}
          columnMetadata={this.props.columnMetadata}
          externalSortAscending={this.state.externalSortAscending}/>
      </div>
    );
  }

}
