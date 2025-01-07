<!DOCTYPE html>
<html lang="en">
   <head>
      @include('adminpages.css')
      <style>
        .card-header {
            display: flex;
            align-items: center;
        }

        .addprivacy {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;            
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left: auto;
        }

        .addprivacy:hover {
            background-color: #45a049;  
        }

        .custom-modal.privacy {
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

 .custom-modal.privacyedit {
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

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            margin-right: 10px;  
        }

        .switch input {
            opacity: 0; 
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: background-color 0.4s, transform 0.4s;  
            border-radius: 34px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            border-radius: 50%;
            transition: transform 0.4s;  
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);  
        }

        input:checked + .slider {
            background-color: #2196F3;  
            transform: scale(1.05);  
        }

        input:checked + .slider:before {
            transform: translateX(26px);  
        }

        input:focus + .slider {
            box-shadow: 0 0 5px #2196F3;  
        }

         

        .wrapper {
            --input-focus: #2d8cf0;
            --font-color: #323232;
            --font-color-sub: #666;
            --bg-color: #fff;
            --bg-color-alt: #666;
            --main-color: #323232;
        }
        
        .flip-card__btn {
            margin: 20px 0;
            width: 120px;
            height: 40px;
            border-radius: 5px;
            border: 2px solid var(--main-color);
            background-color: #4CAF50;
            box-shadow: 4px 4px var(--main-color);
            font-size: 17px;
            font-weight: 600;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .flip-card__btn:hover {
            background-color: #45a049;
        }

        .flip-card__btn:active {
            box-shadow: 0px 0px var(--main-color);
            transform: translate(3px, 3px);
        }

        .modal-content {
    overflow-y: auto; 
    max-height: 750px; 
    padding: 15px;  
    background-color: #f9f9f9;  
    border-radius: 8px; 
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);  
}

 
.modal-content::-webkit-scrollbar {
    width: 10px;  
}

.modal-content::-webkit-scrollbar-track {
    background: #e0e0e0;  
    border-radius: 5px;  
}

.modal-content::-webkit-scrollbar-thumb {
    background: #888;  
    border-radius: 5px;  
}

.modal-content::-webkit-scrollbar-thumb:hover {
    background: #555;  
}

 .modal-content > * {
    margin-bottom: 10px;  
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
                             <h2>Add Policy</h2>
                          </div>
                       </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                      
                       <div class="col-md-12">
                          <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="search-container" style="display: inline-block; float: right; margin-top: 10px;">
                                   <input type="text" class="form-control search-input" placeholder="Search policy...">
                               </div>
                               <div class="heading1 margin_0">
                                <button class="addprivacy">Add Policy</button>
                               </div>
                           </div>
                             <div class="table_section padding_infor_info">
                                <div class="table-responsive-sm">
                                   <table id="privacyTable" class="table">
                                      <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th style="white-space: nowrap;">Main Heading</th>
                                            <th style="white-space: nowrap;">Sub Heading</th>
                                            <th style="white-space: nowrap;">Paragraph</th>
                                            <th style="white-space: nowrap;">ShowOn Terms Page</th>
                                            <th style="white-space: nowrap;">ShowOn Refund Page</th>
                                            <th style="white-space: nowrap;">ShowOn Shipping Page</th>
                                            <th style="white-space: nowrap;">ShowOn Privacy Page</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach($privacies as $privacy)
                                        <tr class="user-row" id="privacy-{{ $privacy->id }}">
                                                <td>{{$counter}}</td>
                                                
                                                <td style="white-space: nowrap;" id="mainheading">{{$privacy->main_heading}}</td>  
                                                <td style="white-space: nowrap;" id="subheading">{{$privacy->sub_heading}}</td> 
                                                <td style="white-space: nowrap;" id="paragraph">{{$privacy->paragraph}}</td>     
                                                <td>
                                                    @if($privacy->show_terms=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($privacy->show_refund=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($privacy->show_shipping=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($privacy->show_privacy=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a id="privacyedittttt" data-privacy-id="{{ $privacy->id }}" class="btn btn-warning ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a data-privacy-id="{{ $privacy->id }}" class="btn btn-danger delprivacy">
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


        <!-- Add privacy data Modal -->
        <div style="display:none;" class="custom-modal privacy" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div style="overflow:auto;height:750px" class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Add Privacy</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="privacyform">
                        <input type="hidden" id="privacyforminput_add" value=""/>
                        <div class="row mt-5">
                           
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="mainheading_add">Main Heading</label>
                                    <input type="text" id="mainheading_add" name="main_heading" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="subheading_add">Sub Heading</label>
                                    <input type="text" id="subheading_add" name="sub_heading" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="paragraph_add">Paragraph</label>
                                    <input type="text" id="paragraph_add" name="paragraph" class="form-control">
                                </div>
                            </div>
                           
                            <div class="col-4 mt-5">
                                <span for="isShowterms">Show on Terms Page</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowterms" name="show_terms">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="col-4 mt-5">
                                <span for="isShowrefund">Show on Refund Page</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowrefund" name="show_refund">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="col-4 mt-5">
                                <span for="isShowshipping">Show on Shipping Page</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowshipping" name="show_shipping">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="col-4 mt-5">
                                <span for="isShowprivacy">Show on Privacy Page</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowprivacy" name="show_privacy">
                                    <span class="slider"></span>
                                </label>
                            </div>
                           
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="privacyadd" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary closeModal">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>


        <!-- Add privacy edit Modal -->
        <div style="display:none" class="custom-modal privacyedit" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Edit Privacy</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
                    <form id="privacyeditform">
                        <input type="hidden" id="privacyforminput_edit" value=""/>
                        <div class="row mt-5">
                             
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="mainheading_edit">Main Heading</label>
                                    <input type="text" id="mainheading_edit" name="main_heading" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="subheading_edit">Sub Heading</label>
                                    <input type="text" id="subheading_edit" name="sub_heading" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="paragraph_edit">Paragraph</label>
                                    <input type="text" id="paragraph_edit" name="paragraph" class="form-control">
                                </div>
                            </div>
                            
                            
                            <div class="col-4 mt-5">
                                <span for="isShowterms_edit">Show on Terms of service</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowterms_edit" name="show_terms">
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div class="col-4 mt-5">
                                <span for="isShowrefund_edit">Show on Refund Policy</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowrefund_edit" name="show_refund">
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div class="col-4 mt-5">
                                <span for="isShowshipping_edit">Show on Shipping Policy</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowshipping_edit" name="show_shipping">
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div class="col-4 mt-5">
                                <span for="isShowprivacy_edit">Show on Privacy Policy</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowprivacy_edit" name="show_privacy">
                                    <span class="slider"></span>
                                </label>
                            </div>

                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="editprivacyForm" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
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
    $(document).on('click', '#privacyadd', function (e) {
        e.preventDefault();

        console.log('Submit button clicked');

        let formData = new FormData();

       
        formData.append('main_heading', $('#mainheading_add').val());
        formData.append('sub_heading', $('#subheading_add').val());
        formData.append('paragraph', $('#paragraph_add').val());

         
        formData.append('show_terms', $('#isShowterms').is(':checked') ? 1 : 0);
        formData.append('show_refund', $('#isShowrefund').is(':checked') ? 1 : 0);
        formData.append('show_shipping', $('#isShowshipping').is(':checked') ? 1 : 0);
        formData.append('show_privacy', $('#isShowprivacy').is(':checked') ? 1 : 0);
        
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: '/save-privacy',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log('AJAX Success:', response);

                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Policy Added',
                        text: 'The policy has been successfully added!',
                    });

                    $('#privacyform')[0].reset();

                    const privacy = response.privacy;
                    const counter = $('#privacyTable tbody tr').length + 1;

                    const newRow = `
                        <tr class="user-row" id="privacy-${privacy.id}">
                            <td>${counter}</td>
                            
                            <td id="mainheading">${privacy.main_heading}</td>
                            <td id="subheading">${privacy.sub_heading}</td>
                            <td style="white-space: nowrap;" id="paragraph">${privacy.paragraph}</td>
                            
                            <td>
                                <h4 style="background-color:${privacy.show_terms ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${privacy.show_terms ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <h4 style="background-color:${privacy.show_refund ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${privacy.show_refund ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <h4 style="background-color:${privacy.show_shipping ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${privacy.show_shipping ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <h4 style="background-color:${privacy.show_privacy ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${privacy.show_privacy ? 'Yes' : 'No'}
                                </h4>
                            </td>
                          
                            <td>
                                <a id="privacyedittttt" data-privacy-id="${privacy.id}" class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a data-privacy-id="${privacy.id}" class="btn btn-danger delprivacy">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528"/>
                                    </svg>
                                </a>
                            </td>
                             
                        </tr>`;

                        $('#privacyTable tbody').append(newRow);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error saving the policy.',
                    });
                }
            },
            error: function (xhr) {
                console.log('AJAX Error:', xhr);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'An unknown error occurred.',
                });
            },
        });
    });
});

// get privacy data
$(document).on('click', '#privacyedittttt', function () {
    var privacyId = $(this).data('privacy-id');
    console.log('id:',privacyId )
 
     $.ajax({
        url: "{{ route('privacy.show', '') }}/" + privacyId, 
        type: "GET",  
        success: function (response) {
            if (response.success) {
                $('#privacyforminput_edit').val(response.privacy.id);
                $('#mainheading_edit').val(response.privacy.main_heading);
                $('#subheading_edit').val(response.privacy.sub_heading);
                $('#paragraph_edit').val(response.privacy.paragraph);
                $('#isShowterms_edit').prop('checked', !!response.privacy.show_terms);
                $('#isShowrefund_edit').prop('checked', !!response.privacy.show_refund);
                $('#isShowshipping_edit').prop('checked', !!response.privacy.show_shipping);
                $('#isShowprivacy_edit').prop('checked', !!response.privacy.show_privacy);
                $('.custom-modal.privacyedit').fadeIn();
                 $('.custom-modal.privacyedit').fadeIn();
            }
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to fetch policy details.',
                confirmButtonText: 'Ok'
            });
        }
    });
});

$(document).on('click', '#editprivacyForm', function (e) {
    e.preventDefault();   

    const formData = new FormData($('#privacyeditform')[0]);   
    const privacyId = $('#privacyforminput_edit').val();

    formData.append('show_terms', $('#isShowterms_edit').is(':checked') ? 1 : 0);
    formData.append('show_refund', $('#isShowrefund_edit').is(':checked') ? 1 : 0);
    formData.append('show_shipping', $('#isShowshipping_edit').is(':checked') ? 1 : 0);
    formData.append('show_privacy', $('#isShowprivacy_edit').is(':checked') ? 1 : 0);

    formData.append('main_heading', $('#mainheading_edit').val());
    formData.append('sub_heading', $('#subheading_edit').val());
    formData.append('paragraph', $('#paragraph_edit').val());

    $.ajax({
        url: `/privacy/update/${privacyId}`,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.success) {
                const privacyRow = $(`a[data-privacy-id="${privacyId}"]`).closest('tr');
                
                privacyRow.find('td:nth-child(2)').text(response.privacy.main_heading);
                privacyRow.find('td:nth-child(3)').text(response.privacy.sub_heading);
                privacyRow.find('td:nth-child(4)').text(response.privacy.paragraph);
                privacyRow.find('td:nth-child(5)').html(response.privacy.show_terms == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );
                privacyRow.find('td:nth-child(6)').html(response.privacy.show_refund == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );
                privacyRow.find('td:nth-child(7)').html(response.privacy.show_shipping == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );
                privacyRow.find('td:nth-child(8)').html(response.privacy.show_privacy == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );

                Swal.fire({
                    icon: 'success',
                    title: 'Policy Updated!',
                    text: 'The policy has been successfully updated.',
                    confirmButtonText: 'OK'
                });

                $('.privacyedit').hide();
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'An error occurred while updating the policy. Please try again.',
                confirmButtonText: 'OK'
            });
        }
    });
});



 $('.closeModal').on('click', function () {
    $('.custom-modal.privacyedit').fadeOut();
});
        </script>
   </body>
</html>