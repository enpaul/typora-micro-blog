// Datatable constructor function
$(document).ready(function() {
  var table = $('#PostList').DataTable({
    "searching": true, // Disable user search filtering field
    "processing": true, // Disable showing the 'processing' indicator on refresh
    "order": [[1, 'desc']], // Set the ordering column and direction
    "ordering": true,
    "stateSave": false, // Modifies the browser history with pagination and ordering changes so the browser 'back' button works properly
    "pageLength": 15, // Sets the number of results to display per page
    "lengthChange": false,
    "pagingType": "simple_numbers", // Modifies pagination layout: only shows 'next'/'previous'
    "ajax": { // Server processing configuration information
      url: "get-posts/index.php?process=format", // Server script for server-side data processing
      type: "POST", // Method of ajax data transmission to server script
    }, // Source/access method for the server-side processing data source
    "columns": [ // Columns to be populated by the ajax data. Must match index keys set in search engine
      { data: 'Title', className: "post-title"},
      { data: 'Details', className: "post-details"}, // 'className' assigns the class 'greyColumn' to this column for CSS modification
    ],
    "language": { // Text output information modification settings
       "processing": "<p>Loading documents...</p>", // Processing dialog replacement
       "info": "<span id='PostListNumber'>&nbsp;_TOTAL_ documents available</span>", // Results text
       "infoEmpty": "<span id='PostListNumber'>&nbsp;No documents available</span>", // Results text when results = 0
       "infoFiltered": "(of _MAX_ total documents)", // Additional text for info when searching
       "search": "",
       "searchPlaceholder": "Search by title, tag, date, or author", // Search bar accompanying text
       "paginate": { // Pagination button text configuration
          "previous": '<span style="text-decoration: none;" onclick="$(\'html,body\').scrollTop(0);">&lt;</span>',
          "next": '<span style="text-decoration: none;" onclick="$(\'html,body\').scrollTop(0);">&gt;</span>'
      },
      "emptyTable": "<b>No public documents</b>" // Empty result set text replacement
    },
    // The below command is a doozy. It sets up the order and arrangement of the various table elements. Full documentation available here: https://datatables.net/reference/option/dom
    "dom": '<"#PostListSearch"f><"#PostListInterface"i l p>r' + 't' + '<"#PostListInterface"i l p>',
  });
});

// Tag search function
$(document).ready(function() {
  $('span.tag').on("click", function() {
    var tag = this.innerHTML;
    var value = $("#PostList_filter input").val() + tag + " ";
    $("#PostList_filter input").val(value);
    $("#PostList").DataTable().search(value).draw();
  });
});
