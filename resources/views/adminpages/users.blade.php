 <!DOCTYPE html>
<html lang="en">
   <head>
      @include('adminpages.css')
      <style>
        @media (max-width: 768px) {
  .modal-dialog {
    max-width: 95%;
    width: auto;
    margin: 10px;
  }

  .modal-content {
    padding: 15px;
  }
}

@media (max-width: 576px) {
  .modal-dialog {
    max-width: 100%;
    margin: 5px;
  }

  .modal-content {
    padding: 10px;
  }
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
                                  <input type="text" class="form-control search-input" placeholder="Search Users...">
                              </div>
                              <div class="heading1 margin_0">
                                  <h2>Users</h2>
                              </div>
                          </div>
                            <div class="table_section padding_infor_info">
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>UserType</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-body">
                                            @php $counter = 1; @endphp
                                            @foreach($users as $user)
                                                <tr class="user-row">
                                                    <td>{{ $counter }}</td>
                                                    <td>
                                                        <img height="80" width="80" src="{{ asset($user->photo_path ? $user->photo_path : 'dummy.png') }}" />
                                                    </td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->userType }}</td>
                                                    <td>
                                                        <a data-user-id="{{ $user->id }}" class="btn btn-warning mx-5 edit-user-btn">
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                                          </svg>
                                                         </a>
                                                    </td>
                                                    <td>
                                                        @if($user->userType != 1)
                                                            <a data-user-id="{{ $user->id }}" class="btn btn-danger deluser">
                                                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                                  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                                </svg>     
                                                            </a>
                                                        @endif
                                                    </td>
                                                    @php $counter++; @endphp
                                                </tr>
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

                 
 <div class="container-fluid" style="margin-top:10%">
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

        <!-- Edit User Modal -->
<!-- Edit User Modal -->
<div class="custom-modal" id="editUserModal" aria-hidden="true" tabindex="-1" style="
display: none; 
position: fixed; 
z-index: 1050; 
left: 0; 
top: 0; 
width: 100%; 
height: 100%; 
background-color: rgba(0, 0, 0, 0.5); 
justify-content: center; 
align-items: center; 
animation: fadeIn 0.3s ease;">
  <div class="modal-dialog modal-dialog-centered" style="
    max-width: 90%; 
    width: 600px; 
    margin: 0 auto;">
    <div class="modal-content" style="
        background-color: white; 
        padding: 20px; 
        border-radius: 8px; 
        text-align: center; 
        animation: slideDown 0.5s ease;">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
      </div>
      <form>
        <div class="modal-body">
          <input type="hidden" id="edituserid" value=""/>

          <div class="form-group">
            <label for="editName" style="text-align: left; display: block; margin-bottom: 0.5rem;">Name</label>
            <input type="text" class="form-control" id="editName">
          </div>
          <div class="form-group">
            <label for="editEmail" style="text-align: left; display: block; margin-bottom: 0.5rem;">Email</label>
            <input type="email" class="form-control" id="editEmail">
          </div>
          <div class="form-group">
            <label for="editUserType" style="text-align: left; display: block; margin-bottom: 0.5rem;">User Type</label>
            <input type="text" class="form-control" id="editUserType">
          </div>
        </div>
        <div class="modal-footer">
          <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="submitEdit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>



       @include('adminpages.js')
       @include('ajax')
   </body>
</html>