<meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!-- Title  -->
    <title>Ecommerce</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{asset('essence/img/core-img/favicon.ico')}}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{asset('essence/css/core-style.css')}}">
    <link rel="stylesheet" href="{{asset('essence/style.css')}}">

    <style>
        .user-name {
    margin-top: 20px;  
}

 

@media (max-width: 1200px) {
    .user-name {
        margin-top: 20px;
    }
}

@media (max-width: 992px) {
    .user-name {
        margin-top: 20px;
    }
}

@media (max-width: 768px) {
    .user-name {
        margin-top: 1px;
    }
}

@media (max-width: 576px) {
    .user-name {
        margin-top: 1px;
    }
}


.user-dropdown {
    position: relative;
    display: inline-block;
}

 
.user-name {
    text-decoration: none;
    color: #000;  
    cursor: pointer;
}

 
.dropdown-checkbox {
    display: none;
}

 
.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #f9f9f9;
    min-width: 100px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    padding: 8px 0;
}

 
.dropdown-checkbox:checked + label + .dropdown-menu {
    display: block;
}

.dropdown-menu a {
    color: black;
    padding: 8px 12px;
    text-decoration: none;
    display: block;
}

.dropdown-menu a:hover {
    background-color: #f1f1f1;
}

.pagination .page-item.active .page-link {
    color: #fff;
}

.single-product-wrapper .size-options {
    display: none;
    margin-top: 10px;
}

.single-product-wrapper:hover .size-options {
    display: block;
}

.size-options label {
    display: block;
    font-size: 14px;
    color: #333;
    margin-bottom: 5px;
}

.hover-content {
    position: relative;
}


     .reviews-scroll-container {
        overflow-x: auto;
        display: flex;
        gap: 15px;
        padding-bottom: 20px;
        height: fit-content;
        scrollbar-width: thin;  
        scrollbar-color: #000 #ccc;  
    }

     .reviews-scroll-container::-webkit-scrollbar {
        width: 8px;  
        height: 8px;  
    }

    .reviews-scroll-container::-webkit-scrollbar-track {
        background-color: #f1f1f1;  
        border-radius: 10px;
    }

    .reviews-scroll-container::-webkit-scrollbar-thumb {
        background-color: #888;  
        border-radius: 10px;
        border: 2px solid #f1f1f1;  
    }

    .reviews-scroll-container::-webkit-scrollbar-thumb:hover {
        background-color: #555;  
    }

    #whatsapp-chat {
    position: fixed;
    bottom: 10px;
    right: 20px;
    z-index: 1000;
    display: flex;
    align-items: center;
    gap: 10px;  
     
    padding: 10px;
    border-radius: 50px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.whatsapp-text {
    background-color: white;
    color: #25d366;
    font-size: 14px;
    font-weight: bold;
    padding: 8px;
    border-radius: 5px;
    display: inline-block;
}

#whatsapp-chat img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

#whatsapp-chat img:hover {
    transform: scale(1.1);
    box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
}


.paginationforall .page-item {
    display: inline-block;
    margin: 2px;
    text-align: center;
}

.paginationforall .page-link {
    display: inline-block;
    padding: 5px 10px;
    font-size: 14px;
    background-color: #f0f0f0;
    border: 1px solid #ddd;
    border-radius: 3px;
    cursor: pointer;
    color: #333;
}

.paginationforall .page-item.active .page-link {
    background-color: #007bff;
    color: white;
}

.paginationforall .page-item a {
    text-decoration: none;
}

.paginationforall .page-item .page-link i {
    font-size: 16px;
}

.paginationforall {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 5px;
}

.paginationforall .page-item {
    width: auto;
    margin: 5px;
}

 .review-form {
    transition: transform 0.3s ease-in-out;
}

 .review-form.closed {
    display: none;
    transform: translateX(100%);
}


    </style>