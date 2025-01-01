 <!-- topbar -->
 <div class="topbar">
    <nav class="navbar navbar-expand-lg navbar-light">
       <div class="full">
          <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
          <div class="logo_section">
           </div>
          <div class="right_topbar">
             <div class="icon_info">
                <ul>
                   <li><a href="#"> </a></li>
                   <li><a href="#"> </a></li>
                   <li class="messages"><a><i class="fa fa-bell-o"></i><span class="badge">{{$count}}</span></a></li>
                </ul>
                <ul class="user_profile_dd">
                   <li>
                      <a class="dropdown-toggle" data-toggle="dropdown"><span class="name_user">{{$userName}}</span></a>
                      <div class="dropdown-menu">
                         <a class="dropdown-item changepassword">My Profile</a>
                         <a class="dropdown-item logout"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                      </div>
                   </li>
                </ul>
             </div>
          </div>
       </div>
    </nav>
  </div>
  <!-- end topbar -->