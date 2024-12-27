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
          <li>
             <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cog yellow_color"></i><span>Settings</span></a>
             <ul class="collapse list-unstyled" id="element">
                <li class="logout"><a> <span>Logout</span></a></li>
             </ul>
          </li>
        </ul>
    </div>
 </nav>
 <!-- end sidebar -->