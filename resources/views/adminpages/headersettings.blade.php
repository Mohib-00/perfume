<!DOCTYPE html>
<html lang="en">
   <head>
      @include('adminpages.css')
      <style>
        .card-header {
            display: flex;
            align-items: center;
        }

        .addheader {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;            
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left: auto;
        }

        .addheader:hover {
            background-color: #45a049;  
        }

        .custom-modal.header {
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

 .custom-modal.headeredit {
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
                             <h2>Add Data</h2>
                          </div>
                       </div>
                    </div>
                    <div class="row">
                      
                       <div class="col-md-12">
                          <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="search-container" style="display: inline-block; float: right; margin-top: 10px;">
                                   <input type="text" class="form-control search-input" placeholder="Search...">
                               </div>
                               <div class="heading1 margin_0">
                                <button class="addheader">Add</button>
                               </div>
                           </div>
                             <div class="table_section padding_infor_info">
                                <div class="table-responsive-sm">
                                   <table class="table">
                                      <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Image</th>
                                            <th  style="white-space: nowrap;">Heading 1</th>
                                            <th  style="white-space: nowrap;">Heading 2</th>
                                            <th  style="white-space: nowrap;">Heading 3</th>
                                            <th  style="white-space: nowrap;">Heading 4</th>
                                            <th  style="white-space: nowrap;">Heading 5</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach($headers as $header)
                                        <tr class="user-row" id="header-{{ $header->id }}">
                                                <td>{{$counter}}</td>
                                                <td id="icon">
                                                     <img height="80" width="80" src="{{ asset('images/' . $header->image) }}"/>
                                                </td>
                                                <td  style="white-space: nowrap;" id="heading1">{{$header->heading1}}</td> 
                                                <td  style="white-space: nowrap;" id="heading2">{{$header->heading2}}</td>                                                
                                                <td  style="white-space: nowrap;" id="heading3">{{$header->heading3}}</td>                                                
                                                <td  style="white-space: nowrap;" id="heading4">{{$header->heading4}}</td>                                                
                                                <td  style="white-space: nowrap;" id="heading5">{{$header->heading5}}</td>                                                
                                               
                                                <td>
                                                    <a id="headeredit" data-header-id="{{ $header->id }}" class="btn btn-warning edit-header-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a data-header-id="{{ $header->id }}" class="btn btn-danger delheader">
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

        <!-- Add header data Modal -->
        <div style="display:none" class="custom-modal header" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Add Header</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="headerform">
                        <input type="hidden" id="headerforminput_add" value=""/>
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="icon_add">Image</label>
                                    <input type="file" id="icon_add" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="heading1_add">Heading 1</label>
                                    <input type="text" id="heading2_add" name="heading1" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="heading2_add">Heading 2</label>
                                    <input type="text" id="heading2_add" name="heading2" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="heading3_add">Heading 3</label>
                                    <input type="text" id="heading3_add" name="heading3" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="heading4_add">Heading 4</label>
                                    <input type="text" id="heading4_add" name="heading4" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="heading5_add">Heading 5</label>
                                    <input type="text" id="heading5_add" name="heading5" class="form-control">
                                </div>
                            </div>
                           
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="headeradd" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary closeModal">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        


         <!-- Add header edit Modal -->
         <div style="display:none" class="custom-modal headeredit" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Edit Header</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="headereditform">
                        <input type="hidden" id="headerforminput_edit" value=""/>
                        <div class="row mt-5">
                            <div class="col-6">
                            <div class="form-group">
                                <label for="icon_edit">Image</label>
                                <input type="file" id="icon_edit" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="heading1_edit">Heading 1</label>
                                <input type="text" id="heading1_edit" name="heading1" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="heading2_edit">Heading 2</label>
                                <input type="text" id="heading2_edit" name="heading2" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="heading3_edit">Heading 3</label>
                                <input type="text" id="heading3_edit" name="heading3" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="heading4_add">Heading 4</label>
                                <input type="text" id="heading4_edit" name="heading4" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="heading5_add">Heading 5</label>
                                <input type="text" id="heading5_edit" name="heading5" class="form-control">
                            </div>
                        </div>
                       
                          
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="headereditForm" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary closeModal">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        <div id="loader" style="display: none;">
            <div class="spinner"></div>
        </div>

       @include('adminpages.js')
       @include('ajax')
       <script>
     $(document).ready(function () {
    
     $('#headerform').on('submit', function (e) {
    e.preventDefault();   

    let formData = new FormData(this);
    $('#loader').show();
    $.ajax({
        url: "{{ route('header.store') }}",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#loader').hide();
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Header Added!',
                    text: response.message || 'Header added successfully.',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    $('#headerform')[0].reset();
                    $('.custom-modal.header').fadeOut();

                    const header = response.header;
                    const newRow = `
                        <tr data-header-id="${header.id}">
                            <td>${$('.table tbody tr').length + 1}</td>
                            <td><img height="80" width="80" src="{{ asset('images/') }}/${header.image}" /></td>
                            <td>${header.heading1}</td>
                            <td>${header.heading2}</td>
                            <td>${header.heading3}</td>
                            <td>${header.heading4}</td>
                            <td>${header.heading5}</td>
                            <td>
                                <a id="headeredit" data-header-id="${header.id}" class="btn btn-warning edit-header-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a data-header-id="${header.id}" class="btn btn-danger delheader">
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


// get header data
$(document).on('click', '.edit-header-btn', function () {
    var headerId = $(this).data('header-id');
 
     $.ajax({
        url: "{{ route('header.show', '') }}/" + headerId, 
        type: "GET",  
        success: function (response) {
            if (response.success) {
                 $('#headereditform #headerforminput_edit').val(response.header.id);
                 if (response.header.image) {
                    $('#headereditform #icon_edit').attr('src', "{{ asset('images') }}/" + response.header.image);
                }
                 $('#headereditform #heading1_edit').val(response.header.heading1);
                 $('#headereditform #heading2_edit').val(response.header.heading2);
                 $('#headereditform #heading3_edit').val(response.header.heading3);
                 $('#headereditform #heading4_edit').val(response.header.heading4);
                 $('#headereditform #heading5_edit').val(response.header.heading5);
                 $('.custom-modal.headeredit').fadeIn();
            }
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to fetch header details.',
                confirmButtonText: 'Ok'
            });
        }
    });
});

// Edit header 
$('#headereditform').on('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this); 
    var headerId = $('#headerforminput_edit').val(); 
    $('#loader').show();
  
    $.ajax({
    url: "{{ route('header.update', '') }}/" + headerId,  
    type: "POST",  
    data: formData,
    contentType: false, 
    processData: false, 
    success: function (response) {
        $('#loader').hide();
        if (response.success) {
            Swal.fire({
                icon: 'success',
                title: 'Header Updated!',
                text: response.message || 'Header updated successfully.',
                confirmButtonText: 'Ok'
            }).then(() => {
                $('#headereditform')[0].reset();
                $('.custom-modal.headeredit').fadeOut();
                const header = $(`a[data-header-id="${headerId}"]`).closest('tr');

                header.find('td:nth-child(2) img').attr('src', `/images/${response.header.image}`);
                header.find('td:nth-child(3)').text(response.header.heading1);
                header.find('td:nth-child(4)').text(response.header.heading2);
                header.find('td:nth-child(5)').text(response.header.heading3);
                header.find('td:nth-child(6)').text(response.header.heading4);
                header.find('td:nth-child(7)').text(response.header.heading5);

            });
        }
    },
    error: function (xhr) {
        $('#loader').hide();
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
    $('.custom-modal.headeredit').fadeOut();
});
        </script>
   </body>
</html>
