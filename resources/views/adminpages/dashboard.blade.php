<div class="container-fluid">
    <div class="row column_title">
       <div class="col-md-12">
          <div class="page_title">
             <h2>Dashboard</h2>
          </div>
       </div>
    </div>
    <div class="row column1">
       <div class="col-md-6 col-lg-3">
          <div class="full counter_section margin_bottom_30">
             <div class="couter_icon">
                <div> 
                   <i class="fa fa-user yellow_color"></i>
                </div>
             </div>
             <div class="counter_no">
                <div>
                   <p class="total_no">{{$userCount}}</p>
                   <p class="head_couter">Welcome</p>
                </div>
             </div>
          </div>
       </div>
       <div class="col-md-6 col-lg-3">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div> 
                  <i class="fa fa-user yellow_color"></i>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <p class="total_no">{{$customer}}</p>
                  <p class="head_couter">Customers</p>
               </div>
            </div>
         </div>
      </div>
       <div class="col-md-6 col-lg-3">
          <div class="full counter_section margin_bottom_30">
             <div class="couter_icon">
                <div> 
                   <i class="fa fa-clock-o blue1_color"></i>
                </div>
             </div>
             <div class="counter_no">
                <div>
                   <p class="total_no">{{$newOrders}}</p>
                   <p class="head_couter">New Order</p>
                </div>
             </div>
          </div>
       </div>
       <div class="col-md-6 col-lg-3">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div> 
                  <i class="fa fa-clock-o blue1_color"></i>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <p class="total_no">{{$oldOrders}}</p>
                  <p class="head_couter">Old Order</p>
               </div>
            </div>
         </div>
      </div>
       
       <div class="col-md-6 col-lg-3">
          <div class="full counter_section margin_bottom_30">
             <div class="couter_icon">
                <div> 
                   <i class="fa fa-cloud-download green_color"></i>
                </div>
             </div>
             <div class="counter_no">
                <div>
                   <p class="total_no">{{$product}}</p>
                   <p class="head_couter">Collections</p>
                </div>
             </div>
          </div>
       </div>

       <div class="col-md-6 col-lg-3">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div> 
                  <svg style="color:blue;font-weight:bolder" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-border-outer" viewBox="0 0 16 16">
                     <path d="M7.5 1.906v.938h1v-.938zm0 1.875v.938h1V3.78h-1zm0 1.875v.938h1v-.938zM1.906 8.5h.938v-1h-.938zm1.875 0h.938v-1H3.78v1zm1.875 0h.938v-1h-.938zm2.813 0v-.031H8.5V7.53h-.031V7.5H7.53v.031H7.5v.938h.031V8.5zm.937 0h.938v-1h-.938zm1.875 0h.938v-1h-.938zm1.875 0h.938v-1h-.938zM7.5 9.406v.938h1v-.938zm0 1.875v.938h1v-.938zm0 1.875v.938h1v-.938z"/>
                     <path d="M0 0v16h16V0zm1 1h14v14H1z"/>
                   </svg>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <p class="total_no">{{$newOrders}}</p>
                  <p class="head_couter">Order Pending</p>
               </div>
            </div>
         </div>
      </div>

       <div class="col-md-6 col-lg-3">
          <div class="full counter_section margin_bottom_30">
             <div class="couter_icon">
                <div> 
                  <svg style="color:green;font-weight:bolder" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-chat-fill" viewBox="0 0 16 16">
                     <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9 9 0 0 0 8 15"/>
                   </svg>
                </div>
             </div>
             <div class="counter_no">
                <div>
                   <p class="total_no">{{$message}}</p>
                   <p class="head_couter">Comments</p>
                </div>
             </div>
          </div>
       </div>

       <div class="col-md-6 col-lg-3">
         <div class="full counter_section margin_bottom_30">
            <div class="couter_icon">
               <div> 
                  <svg style="color:red;font-weight:bolder" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                     <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
                   </svg>
               </div>
            </div>
            <div class="counter_no">
               <div>
                  <p class="head_couter">Total Revenue</p>
                  <p class="total_no">Rs:{{ number_format($totalAmount, 2) }}</p>
                  
               </div>
            </div>
         </div>
      </div>

       @if ($outOfStockProducts->isNotEmpty())
       <div class="row">
         @foreach ($outOfStockProducts as $product)
             <div class="col-md-6 col-lg-3">
                 <div class="full counter_section margin_bottom_30">
                     <div class="couter_icon">
                        <div>
                           <p style="color:black;font-weight:bolder" class="total_no">{{ $product->name }}</p>
                           <p sty class="head_couter">This product is out of stock now</p>
                       </div>
                     </div>
                      
                 </div>
             </div>
         @endforeach
     </div>
     @endif
     

       

    </div>
   
     
  </div>