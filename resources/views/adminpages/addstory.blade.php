<!DOCTYPE html>
<html lang="en">
   <head>
      @include('adminpages.css')
      <style>
        .card-header {
            display: flex;
            align-items: center;
        }

        .addstory {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;            
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left: auto;
        }

        .addstory:hover {
            background-color: #45a049;  
        }

        .custom-modal.story {
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

 .custom-modal.storyedit {
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
                             <h2>Add Story Data</h2>
                          </div>
                       </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                      
                       <div class="col-md-12">
                          <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="search-container" style="display: inline-block; float: right; margin-top: 10px;">
                                   <input type="text" class="form-control search-input" placeholder="Search Story...">
                                </div>
                                <div class="heading1 margin_0">
                                @if(!$hasStoryData)
                                <button class="addstory">Add</button>
                                @endif
                                </div>
                           </div>
                             <div class="table_section padding_infor_info">
                                <div class="table-responsive-sm">
                                   <table class="table">
                                      <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Image</th>
                                            <th style="white-space: nowrap;">Image Story</th>
                                            <th style="white-space: nowrap;">Image Story Container</th>
                                            <th>Heading</th>
                                            <th style="white-space: nowrap;">Heading Story</th>
                                            <th>Paragraph</th>
                                            <th style="white-space: nowrap;">Paragraph Story</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach($stories as $story)
                                        <tr class="user-row" id="story-{{ $story->id }}">
                                                <td>{{$counter}}</td>
                                                <td id="icon">
                                                     <img height="80" width="80" src="{{ asset('images/' . $story->image) }}"/>
                                                </td>
                                                <td id="imagestory">
                                                    <img height="80" width="80" src="{{ asset('images/' . $story->image_story) }}"/>
                                                </td>
                                                <td id="image">
                                                    <img height="80" width="80" src="{{ asset('images/' . $story->image_1) }}"/>
                                               </td>

                                                <td id="heading">{{$story->heading}}</td>  
                                                <td id="heading_story">{{$story->heading_story}}</td> 
                                                <td id="paragraph">{{$story->paragraph}}</td> 
                                                <td id="paragraph_story">{{$story->paragraph_story}}</td>                                                
                                                <td>
                                                    <a id="storyedit" data-story-id="{{ $story->id }}" class="btn btn-warning mx-5 edit-story-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a data-story-id="{{ $story->id }}" class="btn btn-danger delstory">
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

        <!-- Add story data Modal -->
        <div style="display:none" class="custom-modal story" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Add Story</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="storyform">
                        <input type="hidden" id="storyforminput_add" value=""/>
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="icon_add">Image</label>
                                    <input type="file" id="icon_add" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group">
                                <label for="imagestory_add">Image Story</label>
                                <input type="file" id="imagestory_add" name="image_story" class="form-control">
                            </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image_add">Image Container</label>
                                    <input type="file" id="image_add" name="image_1" class="form-control">
                                </div>
                                </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="heading_add">Heading</label>
                                    <input type="text" id="heading_add" name="heading" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="headingstory_add">Heading Story</label>
                                    <input type="text" id="headingstory_add" name="heading_story" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="paragraph_add">Paragraph</label>
                                    <input type="text" id="paragraph_add" name="paragraph" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="paragraphstory_add">Paragraph Story</label>
                                    <input type="text" id="paragraphstory_add" name="paragraph_story" class="form-control">
                                </div>
                            </div>
                            
                           
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="storyadd" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary closeModal">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        


         <!-- Add story edit Modal -->
         <div style="display:none" class="custom-modal storyedit" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Edit Story</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="storyeditform">
                        <input type="hidden" id="storyforminput_edit" value=""/>
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="icon_edit">Image</label>
                                    <input type="file" id="icon_edit" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group">
                                <label for="imagestory_edit">Image Story</label>
                                <input type="file" id="imagestory_edit" name="image_story" class="form-control">
                            </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image_edit">Image Container</label>
                                    <input type="file" id="image_edit" name="image_1" class="form-control">
                                </div>
                                </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="heading_edit">Heading</label>
                                    <input type="text" id="heading_edit" name="heading" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="headingstory_edit">Heading Story</label>
                                    <input type="text" id="headingstory_edit" name="heading_story" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="paragraph_edit">Paragraph</label>
                                    <input type="text" id="paragraph_edit" name="paragraph" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="paragraphstory_edit">Paragraph Story</label>
                                    <input type="text" id="paragraphstory_edit" name="paragraph_story" class="form-control">
                                </div>
                            </div>
                            
                          
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="storyeditForm" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
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
    
     $('#storyform').on('submit', function (e) {
    e.preventDefault();   

    let formData = new FormData(this);
    $('#loader').show();
    $.ajax({
        url: "{{ route('story.store') }}",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#loader').hide();
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'story Added!',
                    text: response.message || 'story added successfully.',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    $('#storyform')[0].reset();
                    $('.custom-modal.story').fadeOut();

                    const story = response.story;
                    const newRow = `
                        <tr data-story-id="${story.id}">
                            <td>${$('.table tbody tr').length + 1}</td>
                            <td><img height="80" width="80" src="{{ asset('images/') }}/${story.image}" /></td>
                            <td><img height="80" width="80" src="{{ asset('images/') }}/${story.image_story}" /></td>
                            <td><img height="80" width="80" src="{{ asset('images/') }}/${story.image_1}" /></td>
                            <td>${story.heading}</td>
                            <td>${story.heading_story}</td>
                            <td>${story.paragraph}</td>
                            <td>${story.paragraph_story}</td>
                            <td>
                                <a id="storyedit" data-story-id="${story.id}" class="btn btn-warning mx-5 edit-story-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a data-story-id="${story.id}" class="btn btn-danger delstory">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    `;

                    $('table tbody').append(newRow);
                    $('.addstory').hide();
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


// get story data
$(document).on('click', '.edit-story-btn', function () {
    var storyId = $(this).data('story-id');
 
    $.ajax({
        url: "{{ route('story.show', '') }}/" + storyId, 
        type: "GET",  
        success: function (response) {
            if (response.success) {
                console.log(response.story);
                $('#storyeditform #storyforminput_edit').val(response.story.id);
                if (response.story.image) {
                    $('#storyeditform #icon_edit').attr('src', "{{ asset('images') }}/" + response.story.image);
                }
                if (response.story.image_story) {
                    $('#storyeditform #imagestory_edit').attr('src', "{{ asset('images') }}/" + response.story.image_story);
                }
                if (response.story.image_1) {
                    $('#storyeditform #image_edit').attr('src', "{{ asset('images') }}/" + response.story.image_1);
                }
                $('#storyeditform #heading_edit').val(response.story.heading);
                $('#storyeditform #headingstory_edit').val(response.story.heading_story);
                $('#storyeditform #paragraph_edit').val(response.story.paragraph);
                $('#storyeditform #paragraphstory_edit').val(response.story.paragraph_story);

                // Show the modal
                $('.custom-modal.storyedit').fadeIn();
            }
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to fetch story details.',
                confirmButtonText: 'Ok'
            });
        }
    });
});


// Edit story 
$('#storyeditform').on('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this); 
    var storyId = $('#storyforminput_edit').val(); 
    $('#loader').show();
  
    $.ajax({
    url: "{{ route('story.update', '') }}/" + storyId,  
    type: "POST",  
    data: formData,
    contentType: false, 
    processData: false, 
    success: function (response) {
        $('#loader').hide();
        if (response.success) {
            Swal.fire({
                icon: 'success',
                title: 'story Updated!',
                text: response.message || 'story updated successfully.',
                confirmButtonText: 'Ok'
            }).then(() => {
                $('#storyeditform')[0].reset();
                $('.custom-modal.storyedit').fadeOut();
                const story = $(`a[data-story-id="${storyId}"]`).closest('tr');

                story.find('td:nth-child(2) img').attr('src', `/images/${response.story.image}`);
                story.find('td:nth-child(3) img').attr('src', `/images/${response.story.image_story}`);
                story.find('td:nth-child(4) img').attr('src', `/images/${response.story.image_1}`);
                story.find('td:nth-child(5)').text(response.story.heading);
                story.find('td:nth-child(6)').text(response.story.heading_story);
                story.find('td:nth-child(7)').text(response.story.paragraph);
                story.find('td:nth-child(8)').text(response.story.paragraph_story);
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
    $('.custom-modal.storyedit').fadeOut();
});
        </script>
   </body>
</html>
