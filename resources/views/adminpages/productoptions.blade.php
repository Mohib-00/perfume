<!DOCTYPE html>
<html lang="en">
   <head>
      @include('adminpages.css')
      <style>
        .card-header {
            display: flex;
            align-items: center;
        }

        .addoption {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;            
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left: auto;
        }

        .addoption:hover {
            background-color: #45a049;  
        }

        .custom-modal.option {
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

 .custom-modal.optionedit {
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
                             <h2></h2>
                          </div>
                       </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                      
                       <div class="col-md-12">
                          <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="search-container" style="display: inline-block; float: right; margin-top: 10px;">
                                   <input type="text" class="form-control search-input" placeholder="Search option...">
                               </div>
                               <div class="heading1 margin_0">
                                </div>
                           </div>
                             <div class="table_section padding_infor_info">
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Product Name</th>
                                                <th>Option</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $counter = 1; @endphp
                                            @foreach($options as $option)
                                            <tr class="user-row" id="option-{{ $option->id }}">
                                                <td>{{$counter}}</td>
                                                
                                                <!-- Product Name Column -->
                                                <td>
                                                    <!-- Display the product name -->
                                                    {{ $option->product->name }} <!-- Assuming 'name' is the product field -->
                                                </td>
                                    
                                                <!-- Option Column -->
                                                <td>
                                                    <!-- Display the option (if image or text) -->
                                                    {{ $option->option }}  <!-- Assuming 'option' is the field in the options table -->
                                                </td>
                                    
                                                <!-- Edit Column -->
                                                <td>
                                                    <a id="optionedit" data-option-id="{{ $option->id }}" class="btn btn-warning mx-5 edit-option-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                    
                                                <!-- Delete Column -->
                                                <td>
                                                    <a data-option-id="{{ $option->id }}" class="btn btn-danger deloptions">
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

        


         <!-- Add option edit Modal -->
         <div style="display:none" class="custom-modal optionedit" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Edit Option</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="optioneditform">
                        <input type="hidden" id="optionforminput_edit" value=""/>
                        <div class="row mt-5">
                             
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="option_edit">Option</label>
                                    <input type="text" id="option_edit" name="option" class="form-control">
                                    <span class="invalid-feedback" id="option_error"></span>
                                </div>
                            </div>

                            
                          
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="optioneditForm" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary closeModal">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>


       @include('adminpages.js')
       @include('ajax')
       <script>
// get option data
$(document).on('click', '.edit-option-btn', function () {
    var optionId = $(this).data('option-id');
 
     $.ajax({
        url: "{{ route('option.show', '') }}/" + optionId, 
        type: "GET",  
        success: function (response) {
            if (response.success) {
                 $('#optioneditform #optionforminput_edit').val(response.option.id);
                 
                 $('#optioneditform #heading_edit').val(response.option.option);
                  $('.custom-modal.optionedit').fadeIn();
            }
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to fetch options.',
                confirmButtonText: 'Ok'
            });
        }
    });
});

// Edit option 
$('#optioneditform').on('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this); 
    var optionId = $('#optionforminput_edit').val(); 

  
    $.ajax({
    url: "{{ route('option.update', '') }}/" + optionId,  
    type: "POST",  
    data: formData,
    contentType: false, 
    processData: false, 
    success: function (response) {
        if (response.success) {
            Swal.fire({
                icon: 'success',
                title: 'option Updated!',
                text: response.message || 'option updated successfully.',
                confirmButtonText: 'Ok'
            }).then(() => {
                $('#optioneditform')[0].reset();
                $('.custom-modal.optionedit').fadeOut();
                const option = $(`a[data-option-id="${optionId}"]`).closest('tr');
                option.find('td:nth-child(3)').text(response.option.option);
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

$('.closeModal').on('click', function () {
    $('.custom-modal.optionedit').fadeOut();
});
        </script>
   </body>
</html>
