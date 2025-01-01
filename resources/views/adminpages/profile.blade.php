<!DOCTYPE html>
<html lang="en">
   <head>
      @include('adminpages.css')
      <style>
        .card-header {
            display: flex;
            align-items: center;
        }

        .addsettingsbtn {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;            
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left: auto;
        }

        .addsettingsbtn:hover {
            background-color: #45a049;  
        }

        .custom-modal.addsettings {
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
 }

 
 .custom-modal1.etstgssettings {
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
                            <h2>Profile</h2>
                         </div>
                      </div>
                   </div>
                   <!-- row -->
                   <div class="row column1">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                         <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                               <div class="heading1 margin_0">
                                  <h2>Admin profile</h2>
                               </div>
                            </div>
                            <div class="full price_table padding_infor_info">
                               <div class="row">
                                  <!-- user profile section --> 
                                  <!-- profile image -->
                                  <div class="col-lg-12">
                                     <div class="full dis_flex center_text">
                                        <div class="profile_img"><img width="150" height="150" class="rounded-circle" src="{{asset('dummy.png')}}" alt="#" /></div>
                                        <div class="profile_contant">
                                           <div class="contact_inner">
                                              <h3>{{$userName}}</h3>
                                                
                                           </div>
                                          
                                        </div>
                                     </div>
                                    
                                  </div>


                                  <div class="white_shd full margin_bottom_30 mt-4">
                                    <div class="full graph_head">
                                       <div class="heading1 margin_0">
                                          <h2>Change Password</h2>
                                       </div>
                                    </div>
                                    <div class="full price_table padding_infor_info">
                                        <div class="row">
                                            <!-- Input Field 1 -->
                                            <div class="col-sm-6">
                                                <label for="password" style="text-align: left; display: block; margin-bottom: 0.5rem;">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="password" name="password">
                                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                                </div>
                                                <span class="text-danger" id="passwordError"></span>
                                            </div>
                                            
                                            <!-- Input Field 2 -->
                                            <div class="col-sm-6">
                                                <label for="confirm_password" style="text-align: left; display: block; margin-bottom: 0.5rem;">Confirm Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="confirm_password" name="password_confirmation">
                                                    <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer;">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                                </div>
                                                <span class="text-danger" id="confirmPasswordError"></span>
                                            </div>
                                        </div>
                                        
                                        <!-- Submit Button -->
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <button type="button" id="submitpassword" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                 </div>

                               </div>
                            </div>
                         </div>
                         <div class="col-md-2"></div>
                      </div>
                      <!-- end row -->
                   </div>
                   <!-- footer -->
                   
                </div>
                <!-- end dashboard inner -->
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
 

       @include('adminpages.js')
       @include('ajax')

       <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
    
    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        const confirmPasswordInput = document.getElementById('confirm_password');
        const icon = this.querySelector('i');
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            confirmPasswordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
            </script>
   </body>
</html>