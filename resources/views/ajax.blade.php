<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
   
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

//register
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    $('#register').on('click', function () {
        Register();
    });

     
    $('#registrationForm').on('keypress', function (e) {
        if (e.which === 13) {  
            e.preventDefault(); 
            Register();
        }
    });

    function Register() {
    $('.text-danger').text('');  

    var formData = {
        name: $('#name').val(),
        email: $('#email').val(),
        password: $('#password').val(),
        confirmPassword: $('#confirmPassword').val()
    };

    var valid = true;

    
    if (!formData.name) {
        $('#nameError').text('The name field is required.');
        valid = false;
    }

    
    if (!formData.email) {
        $('#emailError').text('The email field is required.');
        valid = false;
    }

    
    if (!formData.password) {
        $('#passwordError').text('The password field is required.');
        valid = false;
    } else if (formData.password.length < 8) {
        $('#passwordError').text('Password must be at least 8 characters long.');
        valid = false;
    }

    
    if (!formData.confirmPassword) {
        $('#confirmPasswordError').text('The confirm password field is required.');
        valid = false;
    } else if (formData.password !== formData.confirmPassword) {
        $('#confirmPasswordError').text('Passwords do not match.');
        valid = false;
    }

    if (!valid) {
        return;  
    }

    
    $.ajax({
        url: '/register', 
        type: 'POST',
        data: formData,
        success: function (response) {
            if (response.status) {
                $('#registrationForm')[0].reset();   
                window.location.href = '/login';
            } else {
                if (response.errors) {
                    $.each(response.errors, function (key, error) {
                        $('#' + key + 'Error').text(error[0]);   
                    });
                }
            }
        },
        error: function (xhr) {
             
            if (xhr.status === 401) {
                var response = xhr.responseJSON;
                if (response) {
                    console.error('Registration Failed', response);
                    $('#emailError').text('The email has already been taken');
                } else {
                    $('#emailError').text('The email has already been taken');
                }
            } else {
                $('#emailError').text('The email has already been taken');
            }
        }
    });
}


    
    //login
    $('#login').on('click', function (e) {
        e.preventDefault();
        Login();
    });

    
    $('#loginForm').on('keypress', function (e) {
        if (e.which === 13) {  
            e.preventDefault(); 
            Login();
        }
    });

    function Login() {
    $('.text-danger').text('');  

    var formData = {
        email: $('#loginEmail').val(),
        password: $('#loginPassword').val()
    };

    var valid = true;

    
    if (!formData.email) {
        $('#loginEmailError').text('The email field is required.');
        valid = false;
    }

    if (!formData.password) {
        $('#loginPasswordError').text('The password field is required.');
        valid = false;
    }

    if (!valid) {
        return;  
    }

    $.ajax({
        url: '/login',
        type: 'POST',
        data: formData,
        success: function (response) {
            if (response.status) {
                localStorage.setItem('token', response.token); 
                $('meta[name="csrf-token"]').attr('content', response.csrfToken);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': response.csrfToken
                    }
                });

              
                var url = response.userType === '1' ? '/admin' : '/'; 
                window.location.href = url;
            } else {
                
                if (response.errors) {
                   
                    if (response.errors.email) {
                        $('#loginEmailError').text(response.errors.email[0]);   
                    }
                    if (response.errors.password) {
                        $('#loginPasswordError').text(response.errors.password[0]);   
                    }
                } else {
                    
                    $('#loginEmailError').text(response.message); 
                    $('#loginPasswordError').text(response.message); 
                }
            }
        },
        error: function (xhr) {
            
            if (xhr.status === 401) {
                var response = xhr.responseJSON;
                if (response.errors) {
                    
                    if (response.errors.email) {
                        $('#loginEmailError').text(response.errors.email[0]);
                    } 
                    if (response.errors.password) {
                        $('#loginPasswordError').text(response.errors.password[0]);
                    }
                } else {
                    $('#loginEmailError').text('Invalid credentials');
                    $('#loginPasswordError').text('Invalid credentials');
                }
            }
        }
    });
}

});
     
//logout
$(document).ready(function () {
       
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });

     
    $('.logout').on('click', function () {
   
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    $.ajax({
        url: '/logout',
        type: 'POST',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
        
        success: function (response) {
            if (response.status) {
                localStorage.removeItem('token');
                window.location.href = '/login';

                
                $.ajax({
                    url: '/',
                    type: 'GET',
                    success: function (content) {
                        $('body').html(content);
                    },
                    error: function () {
                        alert('Failed to load content.');
                    }
                });
            } else {
                alert('Logout failed. Please try again.');
            }
        },
        error: function (xhr) {
            console.error(xhr);
            alert('An error occurred while logging out.');
        }
    });
});

$(document).ready(function() {
  
  $('.logoutuser').click(function(e) {
      e.preventDefault();  
      $.ajax({
          url: '/logoutuser',   
          type: 'POST',
          headers: {
              'Authorization': 'Bearer ' + localStorage.getItem('token') 
          },
          success: function(response) {
              
              if (response.status) {
                  localStorage.removeItem('token');
                  window.location.href ='/';
              }
          },
          error: function(xhr, status, error) {
               alert('There was an error logging out.');
          }
      });
  });
});


        
if ((window.location.pathname === '/admin'|| window.location.pathname === '/admin/add-story' || window.location.pathname === '/admin/product-options' || window.location.pathname === '/admin/add-details' || window.location.pathname === '/admin/add-showcase-data' || window.location.pathname === '/admin/users' || window.location.pathname === '/admin/add-carousel-data') && !localStorage.getItem('token')) {
        window.location.href = '/';  
    }

     //to open story  page
   $('.addstoryyyyyy').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/add-story',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/add-story';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

     //to open options  page
   $('.seeproductoptions').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/product-options',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/product-options';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

     //to open details  page
   $('.opeingdetails').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/add-details',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/add-details';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

    //to open products  page
   $('.addproductssssss').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/add-products',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/add-products';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

     //to open showcase  page
   $('.showcaseimage').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/add-showcase-data',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/add-showcase-data';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});


    //to open carousel  page
   $('.carousel').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/add-carousel-data',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/add-carousel-data';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

   //to open admin page
   $('.admin').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

 //to open users page
 $('.users').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/users',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/users';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

    
});



//to open login page
$(document).ready(function() {
    $('.signIn').on('click', function() {
        $.ajax({
            url: '/login',
            method: 'GET',
            success: function(response) {
                window.location.href = '/login';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});

//to open register page
$(document).ready(function() {
    $('.signUp').on('click', function() {
        $.ajax({
            url: '/register',
            method: 'GET',
            success: function(response) {
                window.location.href = '/register';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});

//to open frontend user page
$(document).ready(function() {
    $('.userpage').on('click', function() {
        $.ajax({
            url: '/',
            method: 'GET',
            success: function(response) {
                window.location.href = '/';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});
 

 //for search
$(document).ready(function() {
    $(".search-input").on("keyup", function() {
        var value = $(this).val().toLowerCase(); 
        $(".user-row").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});


$(document).on('click', '.edit-user-btn', function() {
    const userId = $(this).data('user-id');
    $('#edituserid').val(userId);
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/get-user-data',  
        type: 'POST',
        data: { user_id: userId },
        headers: { 'X-CSRF-TOKEN': csrfToken },
        success: function(response) {
          
            if (response.success) {
                 
                $('#editUserId').val(response.user.id);
                $('#editName').val(response.user.name);
                $('#editEmail').val(response.user.email);
                $('#editPassword').val('');  
                $('#editUserType').val(response.user.userType);

                
                const currentUserId = response.currentUser ? response.currentUser.id : null;
                const currentUserType = response.currentUser ? response.currentUser.userType : null;

                 
                if (userId === currentUserId) {
                    
                    $('#editName').parent().show();
                    $('#editEmail').parent().show();
                    $('#editPassword').parent().show();
                } else {
                    
                    $('#editName').parent().hide();
                    $('#editEmail').parent().hide();
                    $('#editPassword').parent().hide();
                }
                $('#editUserModal').css('display', 'flex').hide().fadeIn(300);
            }
        },
        error: function(xhr) {
            console.error(xhr);
            alert('Failed to retrieve user data.');
        }
    });
});

$('#close').on('click', function() {
        $('#editUserModal').fadeOut(300);
});

//to edit user  
$(document).on('click', '#submitEdit', function() {
    const userId = $('#edituserid').val();  
     
    let name = $('#editName').val();
    let email = $('#editEmail').val();
    let password = $('#editPassword').val();
    let userType = $('#editUserType').val();

    

    $.ajax({
        url: `/users/${userId}/edit`,  
        method: 'POST',
        data: {
            name: name,
            email: email,
            password: password,
            userType: userType,
            _token: '{{ csrf_token() }}' 
        },
        success: function(response) {
       
            $(`tr:has(a[data-user-id="${userId}"])`).find('td:nth-child(3)').text(name);  
            $(`tr:has(a[data-user-id="${userId}"])`).find('td:nth-child(4)').text(email);  
            $(`tr:has(a[data-user-id="${userId}"])`).find('td:nth-child(5)').text(userType);  

       
            $('#editUserModal').fadeOut(300);
            $('#close').click();  

          
            Swal.fire(
                'Success!',
                'User updated successfully.',
                'success'
            );
        },
        error: function(xhr) {
            alert('Error updating user: ' + xhr.responseJSON.message);
        }
    });
});

//to del user
$(document).on('click', '.deluser', function() {
    const userId = $(this).data('user-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this user?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                url: '/delete-user',
                type: 'POST',
                data: { user_id: userId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        row.remove(); 
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    Swal.fire(
                        'Error',
                        'An error occurred while deleting the user.',
                        'error'
                    );
                }
            });
        }
    });
});


//to open story page
$(document).ready(function() {
    $('.storypage').on('click', function() {
        $.ajax({
            url: '/pages/about-us',
            method: 'GET',
            success: function(response) {
                window.location.href = '/pages/about-us';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});

$('.home').click(function () {

 
$.ajax({
    url:'/',
    type: 'GET',
    success: function (response) {
        window.location.href ='/';
         
    },
    error: function (xhr, status, error) {
        console.error('AJAX Error: ', status, error);
    }
});
});



//to open sale page
$(document).ready(function() {
    $('.saleeeee').on('click', function() {
        $.ajax({
            url: '/collection/sale-products',
            method: 'GET',
            success: function(response) {
                window.location.href = '/collection/sale-products';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});


//to open contact page
$(document).ready(function() {
    $('.contacttttttt').on('click', function() {
        $.ajax({
            url: '/contact-us',
            method: 'GET',
            success: function(response) {
                window.location.href = '/contact-us';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});

//to open collection page
$(document).ready(function() {
    $('.viewcollection').on('click', function() {
        $.ajax({
            url: '/collections',
            method: 'GET',
            success: function(response) {
                window.location.href = '/collections';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});

$(document).ready(function () {
    const phoneNumber = "03457281472";  
    const countryCode = "92";  
    const formattedNumber = phoneNumber.replace(/^0/, countryCode);  
    const whatsappLink = `https://wa.me/${formattedNumber}`; 

   
    $('.whatsapp').click(function (e) {
        e.preventDefault();   
        
        console.log("whatsapp link clicked!");
        console.log("Formatted WhatsApp link:", whatsappLink);

         $(this).attr("href", whatsappLink);
        
         window.open(whatsappLink, "_blank");
    });
});


//for pagination
const productsPerPage = 12;  
const categoryClass = '.all';  
const paginationClass = '.paginationforall';  

const $container = $(categoryClass);
const $items = $container.find(".col-12.col-sm-6.col-lg-4");  
const totalItems = $items.length;  
const totalPages = Math.ceil(totalItems / productsPerPage);  

function showPage(page) {
    $items.hide();  

    
    const start = (page - 1) * productsPerPage;
    const end = start + productsPerPage;

    
    $items.slice(start, end).show();

    
    $(paginationClass + " .page-item").removeClass("active");
    $(paginationClass + " .page-item[data-page='" + page + "']").addClass("active");
}

function createPagination() {
    const $pagination = $(paginationClass);
    $pagination.empty();  
    $pagination.append('<li class="page-item" data-page="prev"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>');

     for (let i = 1; i <= totalPages; i++) {
        $pagination.append(`<li class="page-item" data-page="${i}"><a class="page-link" href="#">${i}</a></li>`);
    }

     $pagination.append('<li class="page-item" data-page="next"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>');

     showPage(1);
}

 $(paginationClass).on("click", ".page-item", function (event) {
    event.preventDefault();
    let page = $(this).data("page");

    const currentPage = $(paginationClass + " .page-item.active").data("page");

     if (page === "prev") {
        page = currentPage > 1 ? currentPage - 1 : 1;
    } else if (page === "next") {
        page = currentPage < totalPages ? currentPage + 1 : totalPages;
    }

     showPage(page);
});

 createPagination();


 
//to open womenfragrances page
$(document).ready(function() {
    $('.womenfragrances').on('click', function() {
        $.ajax({
            url: '/collections/womens-fragrances',
            method: 'GET',
            success: function(response) {
                window.location.href = '/collections/womens-fragrances';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});

//to open menfragrances page
$(document).ready(function() {
    $('.menfragrances').on('click', function() {
        $.ajax({
            url: '/collections/mens-fragrances',
            method: 'GET',
            success: function(response) {
                window.location.href = '/collections/mens-fragrances';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});

//to open travel-size page
$(document).ready(function() {
    $('.travel').on('click', function() {
        $.ajax({
            url: '/collections',
            method: 'GET',
            success: function(response) {
                window.location.href = '/collections/travel-size';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});

//to open discovery page
$(document).ready(function() {
    $('.discovery').on('click', function() {
        $.ajax({
            url: '/collections/discovery',
            method: 'GET',
            success: function(response) {
                window.location.href = '/collections/discovery';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});


//to open blogs page
$(document).ready(function() {
    $('.openblogs').on('click', function() {
        $.ajax({
            url: '/blogs',
            method: 'GET',
            success: function(response) {
                window.location.href = '/blogs';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});


//to open product details page
$(document).ready(function() {
    $('.single-product-wrapper').on('click', function() {
        $.ajax({
            url: '/product-details',
            method: 'GET',
            success: function(response) {
                window.location.href = '/product-details';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.statusText);
            }
        });
    });
});

$(document).ready(function() {
        
        $('.addsettingsbtn').click(function() {
            $('.custom-modal.addsettings').fadeIn();  
        });

        
        $('.closeModal').click(function() {
            $('.custom-modal.addsettings').fadeOut(); 
        });
 
        $(document).click(function(event) {
            if (!$(event.target).closest('.modal-content').length && !$(event.target).is('.addsettingsbtn')) {
                $('.custom-modal.addsettings').fadeOut(); 
            }
        });
    });



    //to add carousel data
    $(document).ready(function () {
    $('#settingsform').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('carousel.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Settings Saved!',
                        text: response.message || 'The settings were saved successfully.',
                        confirmButtonText: 'Ok',
                    }).then(() => {
                        
                        $('#settingsform')[0].reset();
                        $('#aboutimage').val('');  
                        $('.custom-modal.addsettings').fadeOut();

                        const carousel = response.carousel;

                        const newRow = `
                            <tr data-setting-id="${carousel.id}">
                                <td>${$('.table tbody tr').length + 1}</td> 
                                <td><img height="100" width="100" src="{{ asset('images/') }}/${carousel.image}" /></td>
                                <td>${carousel.name}</td>
                                <td>
                                    <a class="btn btn-warning mx-5 edit-product-btn" data-carousel-id="${carousel.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a.5.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-danger delcarousel" data-carousel-id="${carousel.id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>     
                                    </a>                                                 
                                </td>
                            </tr>
                        `;

                        $('table tbody').append(newRow);
                    });
                }
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    let errorMessages = Object.values(errors)
                        .map(err => err.join('\n'))
                        .join('\n');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessages,
                        confirmButtonText: 'Ok',
                    });
                }
            },
        });
    });


    //to get carousel data
     $('table tbody').on('click', '.edit-product-btn', function () {
        const carouselId = $(this).data('carousel-id');

        $.ajax({
            url: '/get-carousel/' + carouselId,
            method: 'GET',
            success: function (response) {
                $('#settingsforminput').val(response.id);
                $('#name1').val(response.name);
                $('.custom-modal1').attr('aria-hidden', 'false').show();
            },
            error: function () {
                alert('Error fetching settings data');
            },
        });
    });

    $('.closeModal').on('click', function () {
        $('.custom-modal1').attr('aria-hidden', 'true').hide();
    });
});

//to edit carousel
$('#settingsformm').on('submit', function (e) {
    e.preventDefault();

    const carouselId = $('#settingsforminput').val(); 
    const formData = new FormData(this);

    $.ajax({
        url: `/update-carousel/${carouselId}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            const carousel = $(`a[data-carousel-id="${carouselId}"]`).closest('tr');

            carousel.find('td:nth-child(2) img').attr('src', `/images/${response.carousel.image}`);
            carousel.find('td:nth-child(3)').text(response.carousel.name);
            

            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: response.message,
                confirmButtonText: 'OK',
            }).then(() => {
                $('.custom-modal1').hide();   
            });
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Error updating setting: ' + xhr.responseJSON.message,
                confirmButtonText: 'OK',
            });
        }
    });
});

//to del carousel
$(document).on('click', '.delcarousel', function() {
    const carouselId = $(this).data('carousel-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this carousel?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });

            $.ajax({
                url: '/delete-carousel',
                type: 'POST',
                data: { carousel_id: carouselId },  
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        row.remove(); 
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    Swal.fire(
                        'Error',
                        'An error occurred while deleting the message.',
                        'error'
                    );
                }
            });
        }
    });
});



//to open add showcase model
$(document).ready(function() {
     $('.addshowcase').click(function() {
         $('.custom-modal.showcase').fadeIn();  
    });

     $('.closeModal').click(function() {
        $('.custom-modal.showcase').fadeOut(); 
    });

     $(document).click(function(event) {
        if (!$(event.target).closest('.modal-content').length && !$(event.target).is('.addshowcase')) {
            $('.custom-modal.showcase').fadeOut(); 
        }
    });
});

//to del showcase
$(document).on('click', '.delshowcase', function() {
    const showcaseId = $(this).data('showcase-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this showcase?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });

            $.ajax({
                url: '/delete-showcase',
                type: 'POST',
                data: { showcase_id: showcaseId },  
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        row.remove(); 
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    Swal.fire(
                        'Error',
                        'An error occurred while deleting the showcase.',
                        'error'
                    );
                }
            });
        }
    });
});




//to open add product model
$(document).ready(function() {
     $('.addproduct').click(function() {
         $('.custom-modal.product').fadeIn();  
    });

     $('.closeModal').click(function() {
        $('.custom-modal.product').fadeOut(); 
    });

     $(document).click(function(event) {
        if (!$(event.target).closest('.modal-content').length && !$(event.target).is('.addproduct')) {
            $('.custom-modal.product').fadeOut(); 
        }
    });
});

//to del product
$(document).on('click', '.delproduct', function() {
    const productId = $(this).data('product-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this product?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });

            $.ajax({
                url: '/delete-product',
                type: 'POST',
                data: { product_id: productId },  
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        row.remove(); 
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    Swal.fire(
                        'Error',
                        'An error occurred while deleting the product.',
                        'error'
                    );
                }
            });
        }
    });
});



//to open add detail model
$(document).ready(function() {
     $('.adddetail').click(function() {
         $('.custom-modal.detail').fadeIn();  
    });

     $('.closeModal').click(function() {
        $('.custom-modal.detail').fadeOut(); 
    });

     $(document).click(function(event) {
        if (!$(event.target).closest('.modal-content').length && !$(event.target).is('.adddetail')) {
            $('.custom-modal.detail').fadeOut(); 
        }
    });
});

//to del detail
$(document).on('click', '.deldetail', function() {
    const detailId = $(this).data('detail-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this detail?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });

            $.ajax({
                url: '/delete-detail',
                type: 'POST',
                data: { detail_id: detailId },  
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        row.remove(); 
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    Swal.fire(
                        'Error',
                        'An error occurred while deleting the detail.',
                        'error'
                    );
                }
            });
        }
    });
});


$(document).ready(function () {
    $('.explore-product').on('click', function () {
        const slug = $(this).data('slug');   

        $.ajax({
            url: `/explore-product/${slug}`,   
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    window.location.href = data.redirect_url;  
                } else {
                    alert('Error: Product not found!');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});


//to open add option model
$(document).ready(function() {
     $('.addoption').click(function() {
         $('.custom-modal.option').fadeIn();  
    });

     $('.closeModal').click(function() {
        $('.custom-modal.option').fadeOut(); 
    });

     $(document).click(function(event) {
        if (!$(event.target).closest('.modal-content').length && !$(event.target).is('.addoption')) {
            $('.custom-modal.option').fadeOut(); 
        }
    });
});


$(document).ready(function () {
     $('.addoption').click(function () {
        const productId = $(this).data('product-id');
        $('#product_id').val(productId);   
        $('.custom-modal.option').fadeIn();
    });

     $('.closeModal').click(function () {
        $('.custom-modal.option').fadeOut();
    });

     $('#optionform').submit(function (e) {
        e.preventDefault();

        const productId = $('#product_id').val();
        const optionData = $('#option_add').val();

        $.ajax({
            url: '/api/add-option',   
            method: 'POST',
            data: {
                product_id: productId,
                option: optionData
            },
            success: function (response) {
                if (response.success) {
                     Swal.fire({
                        icon: 'success',
                        title: 'Option Added',
                        text: 'The option has been added successfully!',
                    }).then(() => {
                         $('#option_add').val('');
                        $('#product_id').val('');
                        $('.custom-modal.option').fadeOut();   
                    });
                } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'An error occurred while adding the option.',
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                 Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred. Please try again later.',
                });
            }
        });
    });
});

//to del options
$(document).on('click', '.deloptions', function() {
    const optionsId = $(this).data('option-id');  
    const csrfToken = $('meta[name="csrf-token"]').attr('content');  
    const row = $(this).closest('tr'); 

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this option?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });

            $.ajax({
                url: '/delete-options',   
                type: 'POST',
                data: { options_id: optionsId }, 
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        row.remove();   
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    Swal.fire(
                        'Error',
                        'An error occurred while deleting the option.',
                        'error'
                    );
                }
            });
        }
    });
});



//to open add story model
$(document).ready(function() {
     $('.addstory').click(function() {
         $('.custom-modal.story').fadeIn();  
    });

     $('.closeModal').click(function() {
        $('.custom-modal.story').fadeOut(); 
    });

     $(document).click(function(event) {
        if (!$(event.target).closest('.modal-content').length && !$(event.target).is('.addstory')) {
            $('.custom-modal.story').fadeOut(); 
        }
    });
});

//to del story
$(document).on('click', '.delstory', function() {
    const storyId = $(this).data('story-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this story?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': csrfToken }
            });

            $.ajax({
                url: '/delete-story',
                type: 'POST',
                data: { story_id: storyId },  
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('.addstory').show();
                        row.remove(); 
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                    } else {
                        Swal.fire(
                            'Error',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    Swal.fire(
                        'Error',
                        'An error occurred while deleting the story.',
                        'error'
                    );
                }
            });
        }
    });
});
</script>
</body>