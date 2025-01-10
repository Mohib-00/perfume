  <!-- Sidebar  -->
  <nav id="sidebar">
    <div class="sidebar_blog_1">
       <div class="sidebar-header">
          <div class="logo_section">
             <a class="admin"><img class="logo_icon img-responsive admin" src="{{asset('dummy.png')}}" alt="#" /></a>
          </div>
       </div>
       <div class="sidebar_user_info">
          <div class="icon_setting"></div>
          <div class="user_profle_side">
             <div class="user_img"><img class="img-responsive admin" src="{{asset('dummy.png')}}" alt="#" /></div>
             <div class="user_info">
                <h6>{{$userName}}</h6>
                <p><span class="online_animation"></span> Online</p>
             </div>
          </div>
       </div>
    </div>
    <div class="sidebar_blog_2">
       <h4 class="chokokutai-regular">Logix 199</h4>
       <ul class="list-unstyled components"> 
          <li class="users"><a><i class="fa fa-users orange_color"></i> <span>Users</span></a></li>
          <li class="carousel"><a><i class="fa fa-star green_color"></i><span>Add Carousel</span></a></li>
          <li class="showcaseimage"><a><i class="fa fa-folder red_color"></i><span>Add Showcase </span></a></li>
          <li class="addproductssssss"><a><i style="color:black" class="fa fa-globe white_color"></i><span>Add Products</span></a></li>
          <li class="opeingdetails"><a><i class="fa fa-folder green_color"></i><span>Add Opening Details</span></a></li>
          <li class="seeproductoptions"><a><i style="color:black" class="fa fa-star orange_color"></i><span>See Product Options</span></a></li>
          <li class="addstoryyyyyy"><a><i style="color:black" class="fa fa-globe white_color"></i><span>Add Story</span></a></li>
          <li class="messagessss"><a><i class="fa fa-comment white_color"></i><span>Messages</span></a></li>
          <li class="viewfeedback"><a><i class="fa fa-thumbs-up red_color"></i><span>View Feedback</span></a></li>
          <li class="vieworder">
            <a>
               <i class="fa fa-star white_color"></i>
               <span>View Order</span>
               
               <span class="badge badge-danger">{{ $notificationCount }}</span>
            </a>
          </li>
            <li>
             <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cog yellow_color"></i><span>Settings</span></a>
             <ul class="collapse list-unstyled" id="element">
               <li class="addsettingggss"><a><span>Add Setting</span></a></li>
               <li class="changepassword"><a><span>Change Password</span></a></li>
               <li class="addpolicyyyyyy"><a><span>Add Policy</span></a></li>
               <li class="addbankdetails"><a><span>Add Bank Details</span></a></li>
               <li class="addblogs"><a><span>Add Blogs</span></a></li>
               <li class="logout"><a> <span>Logout</span></a></li>
             </ul>
          </li>
        </ul>
    </div>
 </nav>
 <!-- end sidebar -->