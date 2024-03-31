let dataTable;
let dataTableIsInitialized = false;

let dataTableOptions = {
  dom: 'Bfrtilp',
  buttons: [
    {
      extend: 'excelHtml5',
      text: '<i class="fas fa-file-excel"></i> ',
      titleAttr: 'Export to Excel',
      className: 'btn btn-success',
    },
    {
      extend: 'pdfHtml5',
      text: '<i class="fas fa-file-pdf"></i> ',
      titleAttr: 'Export to PDF',
      className: 'btn btn-danger',
    },
    {
      extend: 'print',
      text: '<i class="fa fa-print"></i> ',
      titleAttr: 'Print',
      className: 'btn btn-info',
    },
  ],
  lengthMenu: [5, 10, 15, 20, 100, 200, 500],
  columnDefs: [
    { className: 'centered', targets: [0, 1, 2, 3, 4, 5] },
    { orderable: false, targets: [2] },
    { searchable: false, targets: [1] },
    { width: '20%', targets: [1] },
  ],
  pageLength: 3,
  destroy: true,
  language: {
    processing: 'Processing...',
    lengthMenu: 'Show _MENU_ entries',
    zeroRecords: 'No records found',
    emptyTable: 'No data available in table',
    infoEmpty: 'Showing 0 to 0 of 0 entries',
    infoFiltered: '(filtered from _MAX_ total entries)',
    search: 'Search:',
    infoThousands: ',',
    loadingRecords: 'Loading...',
    paginate: {
      first: 'First',
      last: 'Last',
      next: 'Next',
      previous: 'Previous',
    },
    aria: {
      sortAscending: ': activate to sort column ascending',
      sortDescending: ': activate to sort column descending',
    },
    buttons: {
      copy: 'Copy',
      colvis: 'Column visibility',
      collection: 'Collection',
      colvisRestore: 'Restore visibility',
      copyKeys:
        'Press ctrl or \u2318 + C to copy the table data to your system clipboard. <br /> <br /> To cancel, click on this message or press escape.',
      copySuccess: {
        1: 'Copied 1 row to clipboard',
        _: 'Copied %ds rows to clipboard',
      },
      copyTitle: 'Copy to Clipboard',
      csv: 'CSV',
      excel: 'Excel',
      pageLength: {
        '-1': 'Show all rows',
        _: 'Show %d rows',
      },
      pdf: 'PDF',
      print: 'Print',
      renameState: 'Rename',
      updateState: 'Update',
      createState: 'Create State',
      removeAllStates: 'Remove All States',
      removeState: 'Remove',
      savedStates: 'Saved States',
      stateRestore: 'State %d',
    },
    autoFill: {
      cancel: 'Cancel',
      fill: 'Fill all cells with <i>%d</i>',
      fillHorizontal: 'Fill cells horizontally',
      fillVertical: 'Fill cells vertically',
    },
    decimal: '.',
    searchBuilder: {
      add: 'Add condition',
      button: {
        0: 'Search builder',
        _: 'Search builder (%d)',
      },
      clearAll: 'Clear all',
      condition: 'Condition',
      conditions: {
        date: {
          after: 'After',
          before: 'Before',
          between: 'Between',
          empty: 'Empty',
          equals: 'Equals',
          notBetween: 'Not between',
          notEmpty: 'Not Empty',
          not: 'Not',
        },
        number: {
          between: 'Between',
          empty: 'Empty',
          equals: 'Equals',
          gt: 'Greater than',
          gte: 'Greater than or equal to',
          lt: 'Less than',
          lte: 'Less than or equal to',
          notBetween: 'Not between',
          notEmpty: 'Not empty',
          not: 'Not',
        },
        string: {
          contains: 'Contains',
          empty: 'Empty',
          endsWith: 'Ends with',
          equals: 'Equals',
          notEmpty: 'Not Empty',
          startsWith: 'Starts with',
          not: 'Not',
          notContains: 'Does not Contain',
          notStartsWith: 'Does not start with',
          notEndsWith: 'Does not end with',
        },
        array: {
          not: 'Not',
          equals: 'Equals',
          empty: 'Empty',
          contains: 'Contains',
          notEmpty: 'Not Empty',
          without: 'Without',
        },
      },
      data: 'Data',
      deleteTitle: 'Delete filter rule',
      leftTitle: 'Outdent criteria',
      logicAnd: 'And',
      logicOr: 'Or',
      rightTitle: 'Indent criteria',
      title: {
        0: 'Search builder',
        _: 'Search builder (%d)',
      },
      value: 'Value',
    },
    searchPanes: {
      clearMessage: 'Clear all',
      collapse: {
        0: 'Search Panes',
        _: 'Search Panes (%d)',
      },
      count: '{total}',
      countFiltered: '{shown} ({total})',
      emptyPanes: 'No search panes',
      loadMessage: 'Loading search panes',
      title: 'Active Filters - %d',
      showMessage: 'Show All',
      collapseMessage: 'Collapse All',
    },
    select: {
      cells: {
        1: '1 cell selected',
        _: '%d cells selected',
      },
      columns: {
        1: '1 column selected',
        _: '%d columns selected',
      },
      rows: {
        1: '1 row selected',
        _: '%d rows selected',
      },
    },
    thousands: ',',
    datetime: {
      previous: 'Previous',
      next: 'Next',
      hours: 'Hours',
      minutes: 'Minutes',
      seconds: 'Seconds',
      unknown: '-',
      amPm: ['AM', 'PM'],
      months: {
        0: 'January',
        1: 'February',
        10: 'November',
        11: 'December',
        2: 'March',
        3: 'April',
        4: 'May',
        5: 'June',
        6: 'July',
        7: 'August',
        8: 'September',
        9: 'October',
      },
      weekdays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    },
    editor: {
      close: 'Close',
      create: {
        button: 'New',
        title: 'Create New Record',
        submit: 'Create',
      },
      edit: {
        button: 'Edit',
        title: 'Edit Record',
        submit: 'Update',
      },
      remove: {
        button: 'Delete',
        title: 'Delete Record',
        submit: 'Delete',
        confirm: {
          _: 'Are you sure you want to delete %d rows?',
          1: 'Are you sure you want to delete 1 row?',
        },
      },
      error: {
        system:
          'A system error has occurred (<a target="\\" rel="\\ nofollow" href="\\">More information&lt;\\/a&gt;).</a>',
      },
      multi: {
        title: 'Multiple Values',
        info: 'The selected items contain different values for this record. To edit and set all items of this record to the same value, click or tap here, otherwise they will retain their individual values.',
        restore: 'Undo Changes',
        noMulti:
          'This record can be edited individually, but not as part of a group.',
      },
    },
    info: 'Showing _START_ to _END_ of _TOTAL_ entries',
    stateRestore: {
      creationModal: {
        button: 'Create',
        name: 'Name:',
        order: 'Order',
        paging: 'Paging',
        search: 'Search',
        select: 'Select',
        columns: {
          search: 'Column Search',
          visible: 'Column Visibility',
        },
        title: 'Create New State',
        toggleLabel: 'Include:',
      },
      emptyError: 'Name cannot be empty',
      removeConfirm: 'Are you sure you want to remove this %s?',
      removeError: 'Error removing record',
      removeJoiner: 'and',
      removeSubmit: 'Remove',
      renameButton: 'Rename',
      renameLabel: 'New name for %s',
      duplicateError: 'A state with this name already exists.',
      emptyStates: 'No saved states',
      removeTitle: 'Remove State',
      renameTitle: 'Rename State',
    },
  },
};

const initDataTable = async () => {
  if (dataTableIsInitialized) {
    dataTable.destroy();
  }

  await listUsers();

  dataTable = $('#example').DataTable(dataTableOptions);

  dataTableIsInitialized = true;
};

const listUsers = async () => {
  try {
    const response = await fetch('https://jsonplaceholder.typicode.com/users');
    const users = await response.json();
    console.log(users);

    let content = ``;
    users.forEach((user, index) => {
      content += `
                <tr>
                    <td> ${index + 1} </td>
                    <td> ${user.name} </td>
                    <td> ${user.email} </td>
                    <td> ${user.address.city} </td>
                    <td> ${user.company.name} </td>
                    <td><i class="fa-solid fa-circle-check"></i></td>
                    <td>
                        <button class="btn btn-sm btn-primary"><i class="fa-solid fa-pencil"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>`;
    });
    table_users.innerHTML = content;
  } catch (error) {
    alert(error);
  }
};

window.addEventListener('load', async () => {
  await initDataTable();
});
