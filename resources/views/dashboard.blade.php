<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Support Agent</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  </head>
  <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/boot.min.css') }}">
<style>
    .bg-none{
      background-color: #18ec9bff !important;
      color: #fff !important;
    }
    #facility_table_filter label {
        font-size: 0
    }
    #facility_table_filter label input::after::placeholder {
    content: "Enter your number" !important;
    }
    .button::before { 
    content: "New Button Title"; 
    } 
    /* Assuming the input has a fixed width */
    div.dt-container .dt-search input {
        background-image: url('https://cdn3.iconfinder.com/data/icons/feather-5/24/search-512.png');
        background-size: 18px;
        background-repeat: no-repeat;
        background-position: left 10px center;
        /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); */
        padding: 10px 10px 3px 30px !important;
        border-radius: 20px !important;
        height:80%;
    }

    div.dt-container .dt-paging .dt-paging-button.current {
        color: white !important;
    }

    .dt-buttons .buttons-html5,
    .buttons-collection,
    .buttons-print {
        border-radius: 5px !important;
        background-color: transparent !important;
        border: 1px solid skyblue !important;
        background: none !important;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    /* .dt-buttons button:hover {
        background-color: skyblue !important;
        color: white !important;
    } */

    button.dt-paging-button.current {
        border-radius: 30px !important;
        background-color: skyblue !important;
        border: none !important;
        color: white !important;
    }

    span.dt-paging-button {
        border-radius: 30px !important;
        background-color: skyblue !important;
        border: none !important;
        color: white !important;
    }

    a.dt-paging-button {
        border-radius: 30px !important;
        background-color: transparent !important;
        border: none !important;
        color: black !important;
    }

    .custom-table thead tr {
        /* background-color: rgb(235, 235, 235); */
        /* border: 1px solid lightgray; */
        font-family: Arial, Helvetica, sans-serif;
        line-height: 3rem;
    }
    .custom-table>tbody>tr:nth-of-type(odd){background-color:#f9f9f9}
    .custom-table>tbody>tr:hover{background-color:#f5f5f5}
    #example_wrapper table.dataTable tbody td {
        border: none !important;
        /* background-color:white  !important; */
    }
    .custom-table tbody tr {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        line-height: 3rem;
        padding-left: 10px;
    }

    .dt-info {
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif;
    }
    .total-details .bottom{
        display: flex;
        align-items: center !important;
        margin: auto;
        gap: 10px;
        height: 40px;
        font-weight: bold;
        }

        .total-details .bottom h2{
        margin: 0;
        font-size: 40px;
        }

        .total-details p{
        font-size: 12px;
        }
        div.dt-container .dt-paging .dt-paging-button.last {
            font-size: 24px;
            font-weight:bold;
        }
        div.dt-container .dt-paging .dt-paging-button.next {
            font-size: 24px;
            font-weight:bold;
        }

        div.dt-container .dt-paging .dt-paging-button.previous {
            font-size: 24px;
            font-weight:bold;
        }

        div.dt-container .dt-paging .dt-paging-button.first {
            font-size: 24px;
            font-weight:bold;
        }
        table.dataTable tbody tr:hover {
            background-color: #87ceeb !important;
            color:white;
        }
        .pagination {
        font-size: 12px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 15px !important;
    }

    .pagination .paginate_button a {
        border-radius: 50%;
    }

    .pagination .paginate_button .previous {
        border: none;
        background-color: red;
    }

    .pagination>li:first-child>a,
    .pagination>li:first-child>span,
    .pagination>li:last-child>a,
    .pagination>li:last-child>span {
        border: none !important;
        background-color: transparent;
    }
    .dt-buttons .btn-info{
        color:black;
    }
</style>
<body>
    
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
        <div class="row">
            <div class="col-md-11">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    Support Agent
                </a>          
            </div>
            <div class="col-md-1">
                <a class="dropdown-item" href="{{ route('logout') }}">
                    {{ __('Logout') }}
                </a>
            </div>
        </div>
      
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">

         <div class="table-responsive">  
              <table id="facility_table" class="custom-table display nowrap" width="100%">
                  <thead>
                      <tr  style="border:none;background-color:skyblue !important;color:white;">
                      <th>Reference No.</th>
                      <th>Customer</th>
                      <th>Email</th>
                      <th>Contact No</th>
                      <th>Status</th>
                      <th style="text-align:center">Action</th>
                  </tr>
                  </thead>
              </table>
          </div>
      </div>
    </div>

  </div>
</main>

</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTables/pdfmake-0.1.32/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/DataTables/pdfmake-0.1.32/vfs_fonts.js') }}"></script>
<script>
   $(document).ready(function () {
    var ajax_url = "{{route('agent.index')}}";
  facility_table = $('#facility_table').DataTable({
            processing: true,
            serverSide: true,
            aaSorting: [[0, 'desc']],
            ajax: ajax_url,
            columnDefs: [{
                "targets": [4,5],
                "orderable": false,
                "searchable": false
            }],
            language: {
                    paginate: {
                        previous: '<i class="fa fa-chevron-left"></i>', // Icon for previous page
                        next: '<i class="fa fa-chevron-right"></i>' // Icon for next page
                    },
                },

            columns: [
                { data: 'ref_no', name: 'ref_no' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'new_status', name: 'new_status' },
                { data: 'action', name: 'action' },
            ],
            createdRow: function (row, data, dataIndex) {
              console.log(data)
              if(data.status == 0)
              {
                $(row).attr('class', 'bg-none');
              }
                // $(row).attr('class', 'clickable_td');
                // $(row).attr('data-id', data.id);
            }
        });
        });
</script>
</html>