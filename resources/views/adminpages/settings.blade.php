<!DOCTYPE html>
<html lang="en">
   <head>
      @include('adminpages.css')
      <style>
        .card-header {
            display: flex;
            align-items: center;
        }

        .addsetting {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;            
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left: auto;
        }

        .addsetting:hover {
            background-color: #45a049;  
        }

        .custom-modal.setting {
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

 .custom-modal.settingedit {
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
                             <h2>Add Setting Data</h2>
                          </div>
                       </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                      
                       <div class="col-md-12">
                          <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="search-container" style="display: inline-block; float: right; margin-top: 10px;">
                                   <input type="text" class="form-control search-input" placeholder="Search setting...">
                               </div>
                               <div class="heading1 margin_0">
                                <button class="addsetting">Add Setting Data</button>
                               </div>
                           </div>
                             <div class="table_section padding_infor_info">
                                <div class="table-responsive-sm">
                                   <table class="table">
                                      <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Image</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th style="white-space: nowrap;">Youtube Link</th>
                                            <th style="white-space: nowrap;">Tiktok Link</th>
                                            <th style="white-space: nowrap;">Instagram Link</th>
                                            <th style="white-space: nowrap;">Facebook Link</th>
                                            <th style="white-space: nowrap;">Twitter Link</th>
                                            <th style="white-space: nowrap;">Delivery Charges</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach($settings as $setting)
                                        <tr class="user-row" id="setting-{{ $setting->id }}">
                                                <td>{{$counter}}</td>
                                                <td id="image">
                                                    <img height="80" width="80" src="{{ asset('images/' . $setting->image) }}"/>
                                               </td>
                                               <td id="email">{{$setting->email}}</td>  
                                               <td id="number">{{$setting->number}}</td>    
                                               <td id="youtube">{{$setting->youtube}}</td> 
                                               <td id="tiktok">{{$setting->tiktok}}</td> 
                                               <td id="instagram">{{$setting->instagram}}</td> 
                                               <td id="facebook">{{$setting->facebook}}</td>   
                                               <td id="twitter">{{$setting->twitter}}</td>                                    
                                               <td id="deliverycharges">{{$setting->delivery_charges}}</td>                                                
                                                <td>
                                                    <a id="settingedit" data-setting-id="{{ $setting->id }}" class="btn btn-warning mx-5 edit-setting-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a data-setting-id="{{ $setting->id }}" class="btn btn-danger delsetting">
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

        <!-- Add setting data Modal -->
        <div style="display:none" class="custom-modal setting" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Add Setting</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="settingform">
                        <input type="hidden" id="settingforminput_add" value=""/>
                        <div class="row mt-5">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image_add">Image</label>
                                    <input type="file" id="image_add" name="image" class="form-control">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email_add">Email</label>
                                    <input type="email" id="email_add" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="number_add">Number</label>
                                    <input type="number" id="number_add" name="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="youtube_add">Youtube Link</label>
                                    <input type="text" id="youtube_add" name="youtube" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tiktok_add">Tiktok Link</label>
                                    <input type="text" id="tiktok_add" name="tiktok" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="instagram_add">Insta Link</label>
                                    <input type="text" id="instagram_add" name="instagram" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="facebook_add">Facebook Link</label>
                                    <input type="text" id="facebook_add" name="facebook" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="twitter_add">Twitter Link</label>
                                    <input type="text" id="twitter_add" name="twitter" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="heading_add">Delivery Charges</label>
                                    <input type="number" id="heading_add" name="delivery_charges" class="form-control">
                                </div>
                            </div>
                           
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="settingadd" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary closeModal">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        


         <!-- Add setting edit Modal -->
         <div style="display:none" class="custom-modal settingedit" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Edit Setting</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="settingeditform">
                        <input type="hidden" id="settingforminput_edit" value=""/>
                        <div class="row mt-5">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image_edit">Image</label>
                                    <input type="file" id="imageedit" name="image" class="form-control">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email_edit">Email</label>
                                    <input type="email" id="email_edit" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="number_edit">Number</label>
                                    <input type="number" id="number_edit" name="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="youtube_edit">Youtube Link</label>
                                    <input type="text" id="youtube_edit" name="youtube" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tiktok_edit">Tiktok Link</label>
                                    <input type="text" id="tiktok_edit" name="tiktok" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="instagram_edit">Insta Link</label>
                                    <input type="text" id="instagram_edit" name="instagram" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="facebook_edit">Facebook Link</label>
                                    <input type="text" id="facebook_edit" name="facebook" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="twitter_edit">Twitter Link</label>
                                    <input type="text" id="twitter_edit" name="twitter" class="form-control">
                                </div>
                            </div>
                             
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="heading_edit">Delivery Charges</label>
                                    <input type="text" id="heading_edit" name="delivery_charges" class="form-control">
                                    <span class="invalid-feedback" id="heading_error"></span>
                                </div>
                            </div>
                          
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="settingeditForm" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
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
    
     $('#settingform').on('submit', function (e) {
    e.preventDefault();   

    let formData = new FormData(this);

    $.ajax({
        url: "{{ route('setting.store') }}",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'setting Added!',
                    text: response.message || 'Setting added successfully.',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    $('#settingform')[0].reset();
                    $('.custom-modal.setting').fadeOut();

                    const setting = response.setting;
                    const newRow = `
                        <tr data-setting-id="${setting.id}">
                            <td>${$('.table tbody tr').length + 1}</td>
                            <td><img height="80" width="80" src="{{ asset('images/') }}/${setting.image}" /></td>
                            <td>${setting.email}</td>
                            <td>${setting.number}</td>
                            <td>${setting.youtube}</td>
                            <td>${setting.tiktok}</td>
                            <td>${setting.instagram}</td>
                            <td>${setting.facebook}</td>
                            <td>${setting.twitter}</td>
                            <td>${setting.delivery_charges}</td>
                            <td>
                                <a id="settingedit" data-setting-id="${setting.id}" class="btn btn-warning mx-5 edit-setting-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a data-setting-id="${setting.id}" class="btn btn-danger delsetting">
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


// get setting data
$(document).on('click', '.edit-setting-btn', function () {
    var settingId = $(this).data('setting-id');
 
     $.ajax({
        url: "{{ route('setting.show', '') }}/" + settingId, 
        type: "GET",  
        success: function (response) {
            if (response.success) {
                 $('#settingeditform #settingforminput_edit').val(response.setting.id);
                if (response.setting.image) {
                    $('#settingeditform #image_edit').attr('src', "{{ asset('images') }}/" + response.setting.image);
                }

                $('#settingeditform #email_edit').val(response.setting.email);
                $('#settingeditform #number_edit').val(response.setting.number);
                $('#settingeditform #youtube_edit').val(response.setting.youtube);
                $('#settingeditform #tiktok_edit').val(response.setting.tiktok);
                $('#settingeditform #instagram_edit').val(response.setting.instagram);
                $('#settingeditform #facebook_edit').val(response.setting.facebook);
                $('#settingeditform #twitter_edit').val(response.setting.twitter);
                $('#settingeditform #heading_edit').val(response.setting.delivery_charges);
                $('.custom-modal.settingedit').fadeIn();
            }
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to fetch setting details.',
                confirmButtonText: 'Ok'
            });
        }
    });
});

// Edit setting 
$('#settingeditform').on('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this); 
    var settingId = $('#settingforminput_edit').val();  

    $.ajax({
        url: "{{ route('setting.update', ':id') }}".replace(':id', settingId),  
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Setting Updated!',
                    text: response.message || 'Setting updated successfully.',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    $('#settingeditform')[0].reset();
                    $('.custom-modal.settingedit').fadeOut();
                    const setting = $(`a[data-setting-id="${settingId}"]`).closest('tr');
                    setting.find('td:nth-child(2) img').attr('src', `/images/${response.setting.image}`);
                    setting.find('td:nth-child(3)').text(response.setting.email); 
                    setting.find('td:nth-child(4)').text(response.setting.number); 
                    setting.find('td:nth-child(5)').text(response.setting.youtube); 
                    setting.find('td:nth-child(6)').text(response.setting.tiktok); 
                    setting.find('td:nth-child(7)').text(response.setting.instagram); 
                    setting.find('td:nth-child(8)').text(response.setting.facebook); 
                    setting.find('td:nth-child(9)').text(response.setting.twitter); 
                    setting.find('td:nth-child(10)').text(response.setting.delivery_charges); 
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
    $('.custom-modal.settingedit').fadeOut();
});
        </script>
   </body>
</html>
