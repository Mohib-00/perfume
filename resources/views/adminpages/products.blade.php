<!DOCTYPE html>
<html lang="en">
   <head>
      @include('adminpages.css')
      <style>
        .card-header {
            display: flex;
            align-items: center;
        }

        .addproduct {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;            
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left: auto;
        }

        .addproduct:hover {
            background-color: #45a049;  
        }

        .custom-modal.product {
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

 .custom-modal.productedit {
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
                             <h2>Add Products</h2>
                          </div>
                       </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                      
                       <div class="col-md-12">
                          <div class="white_shd full margin_bottom_30">
                            <div class="full graph_head">
                                <div class="search-container" style="display: inline-block; float: right; margin-top: 10px;">
                                   <input type="text" class="form-control search-input" placeholder="Search product...">
                               </div>
                               <div class="heading1 margin_0">
                                <button class="addproduct">Add Product</button>
                               </div>
                           </div>
                             <div class="table_section padding_infor_info">
                                <div class="table-responsive-sm">
                                   <table  id="productTable" class="table">
                                      <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th style="white-space: nowrap;">Image</th>
                                            <th style="white-space: nowrap;">Hover Image</th>
                                            <th style="white-space: nowrap;">Name</th>
                                            <th style="white-space: nowrap;">Price</th>
                                            <th style="white-space: nowrap;">Discount Price</th>
                                            <th style="white-space: nowrap;">Description</th>
                                            <th style="white-space: nowrap;">Slug</th>
                                            <th style="white-space: nowrap;">Quantity</th>
                                            <th style="white-space: nowrap;">Show Sale Product</th>
                                            <th style="white-space: nowrap;">Show Favourite Product</th>
                                            <th style="white-space: nowrap;">Show Selection Product</th>
                                            <th style="white-space: nowrap;">ShowOn Women Page</th>
                                            <th style="white-space: nowrap;">ShowOn Men Page</th>
                                            <th style="white-space: nowrap;">ShowOn Discovery Page</th>
                                            <th style="white-space: nowrap;">ShowOn Sale Page</th>
                                            <th style="white-space: nowrap;">ShowOn Collection Page</th>
                                            <th style="white-space: nowrap;">ShowOn Explore Page</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th style="white-space: nowrap;">Add Size Options</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1; @endphp
                                        @foreach($products as $product)
                                        <tr class="user-row" id="product-{{ $product->id }}">
                                                <td>{{$counter}}</td>
                                                <td id="image">
                                                     <img height="80" width="80" src="{{ asset('images/' . $product->image) }}"/>
                                                </td>
                                                <td id="hoverimage">
                                                    <img height="80" width="80" src="{{ asset('images/' . $product->hover_image) }}"/>
                                               </td>
                                                <td id="name">{{$product->name}}</td>     
                                                <td id="price">{{$product->price}}</td>                                            
                                                <td id="discountprice">{{$product->discount_price}}</td>
                                                <td id="description">{{$product->description}}</td> 
                                                <td id="slug">{{$product->slug}}</td>  
                                                <td id="quantity">{{$product->quantity}}</td> 
                                                 <td>
                                                    @if($product->show_sale_product=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                     @endif
                                                </td>
                                                <td>
                                                    @if($product->show_favourite_product=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                     @endif
                                                </td>
                                                <td>
                                                    @if($product->show_selection_product=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                     @endif
                                                </td>
                                                <td>
                                                    @if($product->showon_women_page=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                     @endif
                                                </td>
                                                <td>
                                                    @if($product->showon_men_page=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                     @endif
                                                </td>
                                                <td>
                                                    @if($product->showon_discovery_page=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                     @endif
                                                </td>
                                                <td>
                                                    @if($product->showon_sale_page=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                     @endif
                                                </td>
                                                <td>
                                                    @if($product->showon_collection_page=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                     @endif
                                                </td>
                                                <td>
                                                    @if($product->showon_explore_page=='1')
                                                    <h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>
                                                    @else
                                                    <h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>
                                                     @endif
                                                </td>

                                                
                                                <td>
                                                    <a id="productedittttt" data-product-id="{{ $product->id }}" class="btn btn-warning ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a data-product-id="{{ $product->id }}" class="btn btn-danger delproduct">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                        </svg>                                                        
                                                    </a>
                                                </td>
                                                <td>
                                                    <a style="color:white" data-product-id="{{ $product->id }}" class="btn btn-primary addoption">
                                                         Add Option                                                        
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



      <!-- Add option data Modal -->
      <div style="display:none;" class="custom-modal option" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div  class="modal-content">
                <div class="modal-header">
                    <h2 style="font-weight: bolder" class="modal-title">Add Option</h2>
                    <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                        &times;
                    </button>
                </div>
    
                <form id="optionform">
                    <input type="hidden" id="optionforminput_add" value=""/>
                    <input type="hidden" id="product_id" name="product_id" value="" />
                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="option_add">Option</label>
                                <input type="text" id="option_add" name="image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                        <button id="optionadd" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                        <button type="button" class="btn btn-secondary closeModal">Close</button>
                    </div>
                </form>
                
                
            </div>
        </div>
    </div>

        <!-- Add product data Modal -->
        <div style="display:none;" class="custom-modal product" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div style="overflow:auto;height:750px" class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Add Product</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
        
                    <form id="productform">
                        <input type="hidden" id="productforminput_add" value=""/>
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image_add">Image</label>
                                    <input type="file" id="image_add" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hoverimage_add">Hover Image</label>
                                    <input type="file" id="hoverimage_add" name="hover_image" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name_add">Name</label>
                                    <input type="text" id="name_add" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="price_add">Price</label>
                                    <input type="text" id="price_add" name="price" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="discount_add">Discount Price</label>
                                    <input type="text" id="discount_add" name="discount_price" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="description_add">Description</label>
                                    <input type="text" id="description_add" name="description" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="slug_add">Slug</label>
                                    <input type="text" id="slug_add" name="slug" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="quantity_add">Quantity</label>
                                    <input type="text" id="quantity_add" name="quantity" class="form-control">
                                </div>
                            </div>
                             

                            <div class="col-4 mt-5">
                                <span for="isShowsaleproduct">Show on Sale Section</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowsaleproduct" name="show_sale_product">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            
                            <div class="col-4 mt-5">
                                <span for="isShowfavouriteproduct">Show on Favourite Section</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowfavouriteproduct" name="show_favourite_product">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowselectionproduct">Show on Selections Section</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowselectionproduct" name="show_selection_product">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowwomencollection">Show WomenCollection Page</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowwomencollection" name="showon_women_page">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowmencollection">Show on MenCollection Page</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowmencollection" name="showon_men_page">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowdiscovery">Show on Discovery Page</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowdiscovery" name="showon_discovery_page">
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div class="col-4 mt-5">
                                <span for="isShowsaleepage">Show on Sale Page</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowsaleepage" name="showon_sale__page">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowcollection">Show on Collection Page</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowcollection" name="showon_collection_page">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowexplore">Show on Explore Page</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowexplore" name="showon_explore_page">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            
                           
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="productadd" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
                            <button type="button" class="btn btn-secondary closeModal">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        


         <!-- Add product edit Modal -->
         <div style="display:none" class="custom-modal productedit" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-weight: bolder" class="modal-title">Edit Product</h2>
                        <button type="button" class="close closeModal" style="background: transparent; border: none; font-size: 2.5rem; color: #333;">
                            &times;
                        </button>
                    </div>
                    <form id="producteditform">
                        <input type="hidden" id="productforminput_edit" value=""/>
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="image_edit">Image</label>
                                    <input type="file" id="image_edit" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hoverimage_edit">Hover Image</label>
                                    <input type="file" id="hoverimage_edit" name="hover_image" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name_edit">Name</label>
                                    <input type="text" id="name_edit" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="price_edit">Price</label>
                                    <input type="text" id="price_edit" name="price" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="discount_edit">Discount Price</label>
                                    <input type="text" id="discount_edit" name="discount_price" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="description_edit">Description</label>
                                    <input type="text" id="description_edit" name="description" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="slug_edit">Slug</label>
                                    <input type="text" id="slug_edit" name="slug" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="quantity_edit">Quantity</label>
                                    <input type="text" id="quantity_edit" name="quantity" class="form-control">
                                </div>
                            </div>
                             

                            <div class="col-4 mt-5">
                                <span for="isShowsaleproduct_edit">Show on Sale Section</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowsaleproduct_edit" name="show_sale_product">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            
                            <div class="col-4 mt-5">
                                <span for="isShowfavouriteproduct_edit">Show on Favourite Section</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowfavouriteproduct_edit" name="show_favourite_product">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowselectionproduct_edit">Show on Selections Section</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowselectionproduct_edit" name="show_selection_product">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowwomencollection_edit">Show WomenCollection Page</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowwomencollection_edit" name="showon_women_page">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowmencollection_edit">Show on MenCollection Page</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowmencollection_edit" name="showon_men_page">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowdiscovery_edit">Show on Discovery Page</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowdiscovery_edit" name="showon_discovery_page">
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div class="col-4 mt-5">
                                <span for="isShowsaleepage_edit">Show on Sale Page</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowsaleepage_edit" name="showon_sale__page">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowcollection_edit">Show on Collection Page</span>
                                <label class="switch">
                                    <input type="checkbox" id="isShowcollection_edit" name="showon_collection_page">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            <div class="col-4 mt-5">
                                <span for="isShowexplore_edit">Show on Explore Page</span><br>
                                <label class="switch">
                                    <input type="checkbox" id="isShowexplore_edit" name="showon_explore_page">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            
                            
                           
                        </div>
                        <div class="modal-footer mt-5" style="justify-content: flex-end; display: flex;">
                            <button id="editproductForm" type="submit" class="btn btn-primary" style="margin-right: 10px;">Submit</button>
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
    $(document).on('click', '#productadd', function (e) {
        e.preventDefault();

        console.log('Submit button clicked');

        let formData = new FormData();

        formData.append('image', $('#image_add')[0].files[0]);
        formData.append('hover_image', $('#hoverimage_add')[0].files[0]);
        formData.append('name', $('#name_add').val());
        formData.append('price', $('#price_add').val());
        formData.append('discount_price', $('#discount_add').val());
        formData.append('description', $('#description_add').val());
        formData.append('slug', $('#slug_add').val());
        formData.append('quantity', $('#quantity_add').val());
        formData.append('show_sale_product', $('#isShowsaleproduct').is(':checked') ? 1 : 0);
        formData.append('show_favourite_product', $('#isShowfavouriteproduct').is(':checked') ? 1 : 0);
        formData.append('show_selection_product', $('#isShowselectionproduct').is(':checked') ? 1 : 0);
        formData.append('showon_women_page', $('#isShowwomencollection').is(':checked') ? 1 : 0);
        formData.append('showon_men_page', $('#isShowmencollection').is(':checked') ? 1 : 0);
        formData.append('showon_discovery_page', $('#isShowdiscovery').is(':checked') ? 1 : 0);
        formData.append('showon_sale_page', $('#isShowsaleepage').is(':checked') ? 1 : 0);
        formData.append('showon_collection_page', $('#isShowcollection').is(':checked') ? 1 : 0);
        formData.append('showon_explore_page', $('#isShowexplore').is(':checked') ? 1 : 0);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: '/save-product',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log('AJAX Success:', response);

                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Product Added',
                        text: 'The product has been successfully added!',
                    });

                    $('#productform')[0].reset();

                    const product = response.product;
                    const counter = $('#productTable tbody tr').length + 1;

                    const newRow = `
                        <tr class="user-row" id="product-${product.id}">
                            <td>${counter}</td>
                            <td id="image">
                                <img height="80" width="80" src="{{ asset('images/${product.image}') }}" />
                            </td>
                            <td id="hoverimage">
                                <img height="80" width="80" src="{{ asset('images/${product.hover_image}') }}" />
                            </td>
                            <td id="name">${product.name}</td>
                            <td id="price">${product.price}</td>
                            <td id="discountprice">${product.discount_price}</td>
                            <td id="description">${product.description}</td>
                            <td id="slug">${product.slug}</td>
                            <td id="quantity">${product.quantity}</td>
                             <td>
                                <h4 style="background-color:${product.show_sale_product ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${product.show_sale_product ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <h4 style="background-color:${product.show_favourite_product ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${product.show_favourite_product ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <h4 style="background-color:${product.show_selection_product ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${product.show_selection_product ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <h4 style="background-color:${product.showon_women_page ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${product.showon_women_page ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <h4 style="background-color:${product.showon_men_page ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${product.showon_men_page ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <h4 style="background-color:${product.showon_discovery_page ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${product.showon_discovery_page ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <h4 style="background-color:${product.showon_sale_page ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${product.showon_sale_page ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <h4 style="background-color:${product.showon_collection_page ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${product.showon_collection_page ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <h4 style="background-color:${product.showon_explore_page ? 'black' : 'red'};width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">
                                    ${product.showon_explore_page ? 'Yes' : 'No'}
                                </h4>
                            </td>
                            <td>
                                <a id="productedittttt" data-product-id="${product.id}" class="btn btn-warning mx-5  ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a data-product-id="${product.id}" class="btn btn-danger delproduct">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>`;

                        $('#productTable tbody').append(newRow);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error saving the product.',
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

// get product data
$(document).on('click', '#productedittttt', function () {
    var productId = $(this).data('product-id');
    console.log('id:',productId )
 
     $.ajax({
        url: "{{ route('product.show', '') }}/" + productId, 
        type: "GET",  
        success: function (response) {
            if (response.success) {
                $('#productforminput_edit').val(response.product.id);
                $('#icon_edit').attr('src', "{{ asset('images') }}/" + response.product.image || 'default.jpg');
                $('#name_edit').val(response.product.name);
                $('#price_edit').val(response.product.price);
                $('#discount_edit').val(response.product.discount_price);
                $('#description_edit').val(response.product.description);
                $('#slug_edit').val(response.product.slug);
                $('#quantity_edit').val(response.product.quantity);

                 $('#isShowsaleproduct_edit').prop('checked', !!response.product.show_sale_product);
                $('#isShowfavouriteproduct_edit').prop('checked', !!response.product.show_favourite_product);
                $('#isShowselectionproduct_edit').prop('checked', !!response.product.show_selection_product);
                $('#isShowwomencollection_edit').prop('checked', !!response.product.showon_women_page);
                $('#isShowmencollection_edit').prop('checked', !!response.product.showon_men_page);
                $('#isShowdiscovery_edit').prop('checked', !!response.product.showon_discovery_page);
                $('#isShowsaleepage_edit').prop('checked', !!response.product.showon_sale_page);
                $('#isShowcollection_edit').prop('checked', !!response.product.showon_collection_page);
                $('#isShowexplore_edit').prop('checked', !!response.product.showon_explore_page);
                 $('.custom-modal.productedit').fadeIn();
            }
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Failed to fetch product details.',
                confirmButtonText: 'Ok'
            });
        }
    });
});

// Edit product 
$(document).on('submit', '#producteditform', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const productId = $('#productforminput_edit').val();

     console.log('Product ID:', productId);

     const image = $('#image_edit')[0].files[0];
    const hoverImage = $('#hoverimage_edit')[0].files[0];

    if (image) {
        console.log('Appending new main image:', image.name);
        formData.append('image', image);
    }

    if (hoverImage) {
        console.log('Appending new hover image:', hoverImage.name);
        formData.append('hover_image', hoverImage);
    }

    // Append checkboxes
    formData.append('show_sale_product', $('#isShowsaleproduct_edit').is(':checked') ? 1 : 0);
    formData.append('show_favourite_product', $('#isShowfavouriteproduct_edit').is(':checked') ? 1 : 0);
    formData.append('show_selection_product', $('#isShowselectionproduct_edit').is(':checked') ? 1 : 0);
    formData.append('showon_women_page', $('#isShowwomencollection_edit').is(':checked') ? 1 : 0);
    formData.append('showon_men_page', $('#isShowmencollection_edit').is(':checked') ? 1 : 0);
    formData.append('showon_discovery_page', $('#isShowdiscovery_edit').is(':checked') ? 1 : 0);
    formData.append('showon_sale_page', $('#isShowsaleepage_edit').is(':checked') ? 1 : 0);
    formData.append('showon_collection_page', $('#isShowcollection_edit').is(':checked') ? 1 : 0);
    formData.append('showon_explore_page', $('#isShowexplore_edit').is(':checked') ? 1 : 0);

    // Additional fields
    formData.append('name', $('#name_edit').val());
    formData.append('price', $('#price_edit').val());
    formData.append('discount_price', $('#discount_edit').val());
    formData.append('description', $('#description_edit').val());
    formData.append('slug', $('#slug_edit').val());
    formData.append('quantity', $('#quantity_edit').val());

    $.ajax({
        url: `/product/update/${productId}`,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.success) {
                 const productRow = $(`a[data-product-id="${productId}"]`).closest('tr');
                productRow.find('td:nth-child(2) img').attr('src', `/images/${response.product.image}`);
                productRow.find('td:nth-child(3) img').attr('src', `/images/${response.product.hover_image}`);

                productRow.find('td:nth-child(4)').text(response.product.name);
                productRow.find('td:nth-child(5)').text(response.product.price);
                productRow.find('td:nth-child(6)').text(response.product.discount_price);
                productRow.find('td:nth-child(7)').text(response.product.description);
                productRow.find('td:nth-child(8)').text(response.product.slug);
                productRow.find('td:nth-child(9)').text(response.product.quantity);
                productRow.find('td:nth-child(10)').html(response.product.show_sale_product == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );
                productRow.find('td:nth-child(11)').html(response.product.show_favourite_product == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );
                productRow.find('td:nth-child(12)').html(response.product.show_selection_product == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );
                productRow.find('td:nth-child(13)').html(response.product.showon_women_page == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );
                productRow.find('td:nth-child(14)').html(response.product.showon_men_page == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );
                productRow.find('td:nth-child(15)').html(response.product.showon_discovery_page == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );
                productRow.find('td:nth-child(16)').html(response.product.showon_sale_page == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );
                productRow.find('td:nth-child(17)').html(response.product.showon_collection_page == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );
                productRow.find('td:nth-child(18)').html(response.product.showon_explore_page == '1' ? 
                    '<h4 style="background-color:black;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">Yes</h4>' : 
                    '<h4 style="background-color:red;width:45px;border-radius:50%;height:42px;color:white;display:flex;justify-content:center;align-items:center">No</h4>'
                );

                Swal.fire({
                    icon: 'success',
                    title: 'Product Updated!',
                    text: 'The product has been successfully updated.',
                    confirmButtonText: 'OK'
                });

                $('.productedit').hide();
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'An error occurred while updating the product. Please try again.',
                confirmButtonText: 'OK'
            });
        }
    });
});

 $('.closeModal').on('click', function () {
    $('.custom-modal.productedit').fadeOut();
});
        </script>
   </body>
</html>
