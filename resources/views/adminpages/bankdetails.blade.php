<!DOCTYPE html>
<html lang="en">
   <head>
      @include('adminpages.css')
      <style>
        .card-header {
            display: flex;
            align-items: center;
        }

        .adddetail {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;            
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left: auto;
        }

        .adddetail:hover {
            background-color: #45a049;  
        }

        .custom-modal.detail {
     position: fixed;
    z-index: 1050;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
 }

 .custom-modal.detailedit {
     position: fixed;
    z-index: 1050;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
 }

        .modal-dialog {
            max-width: 800px;
            animation: slideDown 0.5s ease;
        }

      
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes slideDown {
            0% { transform: translateY(-50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            height: auto;
            text-align: center;
        }
    </style>
   </head>
   <body class="dashboard dashboard_1">
      <div class="full_container">
         <div class="inner_container">
            @include('adminpages.sidebar')
           
        
            <div id="content">
               @include('adminpages.navbar')
            
               <div class="midde_cont">
                <div class="container-fluid">
                    <div class="row column_title">
                       <div class="col-md-12">
                          <div class="page_title">
                             <h2>Add Bank Details</h2>
                          </div>
                       </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                      
                       <div class="col-md-12">
                          <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="search-container" style="display: inline-block; float: right; margin-top: 10px;">
                                   <input type="text" class="form-control search-input" placeholder="Search detail...">
                               </div>
                               <div class="heading1 margin_0">
                                <button class="adddetail">Add</button>
                               </div>
                           </div>
                             <div class="table_section padding_infor_info">
                                <div class="table-responsive-sm">
                                   <table class="table">
                                      <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th style="white-space: nowrap;">Paragraph</th>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th style="white-space: nowrap;">Account Number</th>
                                            <th>Iban</th>
                                            <th style="white-space: nowrap;">Branch Name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach($details as $detail)
                                        <tr class="user-row" id="detail-{{ $detail->id }}">
                                                <td>{{$counter}}</td>
                                               
                                               <td style="white-space: nowrap;" id="email">{{$detail->paragraph}}</td>  
                                               <td style="white-space: nowrap;" id="number">{{$detail->name}}</td>    
                                               <td style="white-space: nowrap;" id="youtube">{{$detail->title}}</td> 
                                               <td style="white-space: nowrap;" id="tiktok">{{$detail->account_number}}</td> 
                                               <td style="white-space: nowrap;" id="instagram">{{$detail->iban}}</td> 
                                               <td style="white-space: nowrap;" id="facebook">{{$detail->branch_name}}</td>                                                  
                                                <td>
                                                    <a id="detailedit" data-detail-id="{{ $detail->id }}" class="btn btn-warning mx-5 edit-detail-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a data-detail-id="{{ $detail->id }}" class="btn btn-danger deldetail">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                        </svg>                                                        
                                                    </a>
                                                </td>
                                                 
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                    </tbody>
                                   </table>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                </div>

                 
 <div class="container-fluid" style="margin-top:25%">
   <div class="footer">
      <p>Copyright © 2024 Designed by Logix. All rights reserved.<br><br>
         Distributed By: <a>Logix</a>
      </p>
   </div>
</div>
                  
               </div>
             
            </div>
         </div>
      </div>

        <!-- Add detail data Modal -->
        <div style="display:none" class="custom-modal detail" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Add Data</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="detailform">
                        <input type="hidden" id="detailforminput_add" value=""/>
                        <div class="row mt-5">

                            

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="paragraph_add">Paragraph</label>
                                    <input type="text" id="paragraph_add" name="paragraph" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name_add">Name</label>
                                    <input type="text" id="name_add" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title_add">Title</label>
                                    <input type="text" id="title_add" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="accountnmbr_add">Account Number</label>
                                    <input type="text" id="accountnmbr_add" name="account_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="iban_add">IBAN</label>
                                    <input type="text" id="iban_add" name="iban" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="branchname_add">Branch Name</label>
                                    <input type="text" id="branchname_add" name="branch_name" class="form-control">
                                </div>
                            </div>
                             
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="detailadd" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary closeModal">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        


         <!-- Add detail edit Modal -->
         <div style="display:none" class="custom-modal detailedit" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Edit Data</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="detaileditform">
                        <input type="hidden" id="detailforminput_edit" value=""/>
                        <div class="row mt-5">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="paragraph_edit">Paragraph</label>
                                    <input type="text" id="paragraph_edit" name="paragraph" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name_edit">Name</label>
                                    <input type="text" id="name_edit" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title_edit">Title</label>
                                    <input type="text" id="title_edit" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="accountnmbr_edit">Account Number</label>
                                    <input type="text" id="accountnmbr_edit" name="account_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="iban_edit">IBAN</label>
                                    <input type="text" id="iban_edit" name="iban" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="branchname_edit">Branch Name</label>
                                    <input type="text" id="branchname_edit" name="branch_name" class="form-control">
                                </div>
                            </div>
                             
                          
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="detaileditForm" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary closeModal">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>


       @include('adminpages.js')
       @include('ajax')
       <script>
     $(document).ready(function () {
    
     $('#detailform').on('submit', function (e) {
    e.preventDefault();   

    let formData = new FormData(this);

    $.ajax({
        url: "{{ route('detail.store') }}",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'detail Added!',
                    text: response.message || 'Detail added successfully.',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    $('#detailform')[0].reset();
                    $('.custom-modal.detail').fadeOut();

                    const detail = response.detail;
                    const newRow = `
                        <tr data-detail-id="${detail.id}">
                            <td>${$('.table tbody tr').length + 1}</td>
                            <td style="white-space: nowrap;">${detail.paragraph}</td>
                            <td style="white-space: nowrap;">${detail.name}</td>
                            <td style="white-space: nowrap;">${detail.title}</td>
                            <td style="white-space: nowrap;">${detail.account_number}</td>
                            <td style="white-space: nowrap;">${detail.iban}</td>
                            <td style="white-space: nowrap;">${detail.branch_name}</td>
                             
                            <td>
                                <a id="detailedit" data-detail-id="${detail.id}" class="btn btn-warning mx-5 edit-detail-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a data-detail-id="${detail.id}" class="btn btn-danger deldetail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    `;

                    $('table tbody').append(newRow);
                });
            }
        },
        error: function (xhr) {
            let errors = xhr.responseJSON.errors;
            if (errors) {
                let errorMessages = Object.values(errors)
                    .map(err => err.join('\n'))
                    .join('\n');
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessages,
                    confirmButtonText: 'Ok'
                });
            }
        }
    });
});


// get detail data
$(document).on('click', '.edit-detail-btn', function () {
    var detailId = $(this).data('detail-id');
 
     $.ajax({
        url: "{{ route('detail.show', '') }}/" + detailId, 
        type: "GET",  
        success: function (response) {
            if (response.success) {
                 $('#detaileditform #detailforminput_edit').val(response.detail.id);
                 
                $('#detaileditform #paragraph_edit').val(response.detail.paragraph);
                $('#detaileditform #name_edit').val(response.detail.name);
                $('#detaileditform #title_edit').val(response.detail.title);
                $('#detaileditform #accountnmbr_edit').val(response.detail.account_number);
                $('#detaileditform #iban_edit').val(response.detail.iban);
                $('#detaileditform #branchname_edit').val(response.detail.branch_name);
                $('.custom-modal.detailedit').fadeIn();
            }
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to fetch detail details.',
                confirmButtonText: 'Ok'
            });
        }
    });
});

// Edit detail 
$('#detaileditform').on('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this); 
    var detailId = $('#detailforminput_edit').val();  

    $.ajax({
        url: "{{ route('detail.update', ':id') }}".replace(':id', detailId),  
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'detail Updated!',
                    text: response.message || 'detail updated successfully.',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    $('#detaileditform')[0].reset();
                    $('.custom-modal.detailedit').fadeOut();
                    const detail = $(`a[data-detail-id="${detailId}"]`).closest('tr');
                    detail.find('td:nth-child(2)').text(response.detail.paragraph); 
                    detail.find('td:nth-child(3)').text(response.detail.name); 
                    detail.find('td:nth-child(4)').text(response.detail.title); 
                    detail.find('td:nth-child(5)').text(response.detail.account_number); 
                    detail.find('td:nth-child(6)').text(response.detail.iban); 
                    detail.find('td:nth-child(7)').text(response.detail.branch_name); 
                    
                });
            }
        },
        error: function (xhr) {
            let errors = xhr.responseJSON.errors;
            if (errors) {
                let errorMessages = Object.values(errors)
                    .map(err => err.join('\n'))
                    .join('\n');
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessages,
                    confirmButtonText: 'Ok'
                });
            }
        }
    });
});

});

 $('.closeModal').on('click', function () {
    $('.custom-modal.detailedit').fadeOut();
});
        </script>
   </body>
</html>
