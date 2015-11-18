

export function createFetchGridData(localStorageID, link, name) {
  return function fetchGridData(start, length, sort, ascending) {
    return new Promise((resolve, reject) => {
      const storage = window.localStorage[localStorageID];
      const data = {start, length, sort, ascending};
      window.localStorage[localStorageID] = JSON.stringify(data);
      jQuery.get(`${window.location}/ItemEditForm/field/${name}`, data)
        .done(resolve)
        .fail(reject);
    });
  }
}
