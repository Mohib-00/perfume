<!DOCTYPE html>
<html lang="en">
   <head>
      @include('adminpages.css')
      <style>
        .card-header {
            display: flex;
            align-items: center;
        }

        .addshowcase {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;            
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left: auto;
        }

        .addshowcase:hover {
            background-color: #45a049;  
        }

        .custom-modal.showcase {
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

 .custom-modal.showcaseedit {
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
                             <h2>View Order</h2>
                          </div>
                       </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                      
                       <div class="col-md-12">
                          <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="search-container" style="display: inline-block; float: right; margin-top: 10px;">
                                   <input type="text" class="form-control search-input" placeholder="Search Order...">
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
                                            <th>FirstName</th>
                                            <th>LastName</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Province</th>
                                            <th>Total</th>
                                            <th>PaymentType</th>
                                            <th>Delivery</th>
                                            <th>Status</th>
                                            <th style="white-space: nowrap;">View Order</th>
                                            <th style="white-space: nowrap;">Change Delivery status</th>
                                            <th style="white-space: nowrap;">Change Status</th>
                                            <th>Delete</th>
                                             
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach($orders as $order)
                                        <tr class="user-row"  data-order-id="{{ $order->id }}">
                                        <td>{{$counter}}</td>
                                        <td>{{ $order->customer->first_name ?? '' }}</td>
                                        <td>{{ $order->customer->last_name ?? '' }}</td>
                                        <td>{{ $order->customer->email ?? '' }}</td>
                                        <td>{{ $order->customer->phone_number ?? '' }}</td>
                                        <td>{{ $order->customer->address ?? '' }}</td>
                                        <td>{{ $order->customer->city ?? '' }}</td>
                                        <td>{{ $order->customer->province ?? '' }}</td>
                                        <td>{{ $order->total ?? '' }}</td>
                                        <td style="white-space: nowrap;">{{ $order->payment_type ?? '' }}</td>
                                        <td class="status" data-order-id="{{ $order->id }}">{{ $order->delivery_status }}</td>
                                        <td class="statuss">
                                            @if($order->customer->status=='0')
                                            <h4 style="background-color:black;width:45px;border-radius:50%;height:45px;color:white;display:flex;justify-content:center;align-items:center;">New</h4>
                                            @else
                                            <h4 style="background-color:red;width:45px;border-radius:50%;height:45px;color:white;display:flex;justify-content:center;align-items:center">Old</h4>
                                             @endif
                                        </td>
                                        <td>
                                            <a style="color:white" data-order-id="{{ $order->id }}" class="btn btn-info vieww">
                                                 View
                                            </a>
                                        </td>
                                    
                                        <td>
                                            @if ($order->delivery_status === 'completed')
                                            <a  class="btn btn-success mx-5 btnshow">
                                                Delivered
                                            </a>                    
                                            @else
                                                <a id="dlvrycnfrm" data-order-id="{{ $order->id }}" class="btn btn-warning mx-5 btnhide">
                                                    Delivery Confirm
                                                </a>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($order->customer->status == '0')
                                            <a data-order-id="{{ $order->id }}" class="btn btn-warning editorderstatus">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                                </svg>
                                            </a>
                                        @else
                                            <a class="btn btn-warning" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                                </svg>
                                            </a>
                                        @endif
                                        
                                        </td>

                                        <td>
                                            <a style="color: white" data-order-id="{{ $order->id }}" class="btn btn-danger delorder">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                </svg>  
                                            </a>
                                        </td>

                                        </tr>     
                                        @php
                                        $counter++;
                                        @endphp
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

        <!-- Add showcase data Modal -->
        <div style="display:none" class="custom-modal showcase" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Add Showcase</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="showcaseform">
                        <input type="hidden" id="showcaseforminput_add" value=""/>
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="icon_add">Image</label>
                                    <input type="file" id="icon_add" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="heading_add">Name</label>
                                    <input type="text" id="heading_add" name="name" class="form-control">
                                </div>
                            </div>
                           
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="showcaseadd" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary closeModal">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        


         <!-- Add showcase edit Modal -->
         <div style="display:none" class="custom-modal showcaseedit" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Edit Showcase</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="showcaseeditform">
                        <input type="hidden" id="showcaseforminput_edit" value=""/>
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="icon_edit">Image</label>
                                    <input type="file" name="image" id="icon_edit" class="form-control" />
                                    <span class="invalid-feedback" id="icon_error"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="heading_edit">Name</label>
                                    <input type="text" id="heading_edit" name="name" class="form-control">
                                    <span class="invalid-feedback" id="heading_error"></span>
                                </div>
                            </div>
                          
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="showcaseeditForm" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary closeModal">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>


       @include('adminpages.js')
       @include('ajax')
       
   </body>
</html>
