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


        
if ((window.location.pathname === '/admin' || window.location.pathname === '/admin/header-settings' || window.location.pathname === '/admin/add-blogs' || window.location.pathname === '/admin/add-bank-details' || window.location.pathname === '/admin/add-policies' || window.location.pathname === '/admin/orderview' || window.location.pathname === '/admin/view-order' || window.location.pathname === '/admin/view-feedback' || window.location.pathname === '/admin/change-password' || window.location.pathname === '/admin/settings' || window.location.pathname === '/admin/messages'|| window.location.pathname === '/admin/add-story' || window.location.pathname === '/admin/product-options' || window.location.pathname === '/admin/add-details' || window.location.pathname === '/admin/add-showcase-data' || window.location.pathname === '/admin/users' || window.location.pathname === '/admin/add-carousel-data') && !localStorage.getItem('token')) {
        window.location.href = '/';  
    }

     //to open header-settings page
     $('.frontendheader').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/header-settings',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/header-settings';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

    //to open blogs page
    $('.addblogs').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/add-blogs',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/add-blogs';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

    //to open bank details page
    $('.addbankdetails').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/add-bank-details',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/add-bank-details';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});


     //to open policy page
    $('.addpolicyyyyyy').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/add-policies',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/add-policies';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});


$('.vieww').click(function () {
var orderId = $(this).data('order-id');
var baseUrl = "{{ url('') }}";
$.ajax({
    url: baseUrl + '/admin/orderview/${orderId',
    type: 'GET',
    success: function (response) {
        window.location.href = `${baseUrl}/admin/orderview/${orderId}`;
         
    },
    error: function (xhr, status, error) {
        console.error('AJAX Error: ', status, error);
    }
});
});

     //to open order page
     $('.vieworder').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/view-order',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/view-order';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

    //to open profile  page
    $('.viewfeedback').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/view-feedback',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/view-feedback';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

     //to open profile  page
    $('.changepassword').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/change-password',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/change-password';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

    //to open settings  page
    $('.addsettingggss').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/settings',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/settings';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

     //to open message  page
   $('.messagessss').click(function () {
    if (!localStorage.getItem('token')) {
        alert('You need to be logged in to access this page.');
        window.location.href = '/';   
        return;
    }

    var baseUrl = "{{ url('') }}";  
    $.ajax({
        url: baseUrl + '/admin/messages',   
        type: 'GET',
        success: function (response) {
            window.location.href = '/admin/messages';   
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});

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

$('.wishlistpage').click(function () {
    $.ajax({
        url: '/wishlist',
        type: 'GET',
        success: function (response) {
            if (response.noItemsInWishlist) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Items in Wishlist',
                    text: 'You have not added any items to your wishlist yet!',
                    confirmButtonText: 'OK'
                });
            } else {
                window.location.href = '/wishlist';
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
});





$('.checkout').click(function () {

$.ajax({
    url:'/checkout',
    type: 'GET',
    success: function (response) {
        window.location.href ='/checkout';
         
    },
    error: function (xhr, status, error) {
        console.error('AJAX Error: ', status, error);
    }
});
});


//to open cart page
$('.opencart').click(function () {
$.ajax({
    url:'/cart',
    type: 'GET',
    success: function (response) {
        window.location.href ='/cart';
         
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

$(document).ready(function() {
    $('.viewdetail').on('click', function() {
         var productName = $(this).data('product-name');
        
        if (productName) {
             var encodedProductName = encodeURIComponent(productName);
            
             window.location.href = '/product-details/' + encodedProductName;
        } else {
            alert('Product name not found!');
        }
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


//to del feedback
$(document).on('click', '.delfeedback', function() {
    const feedbackId = $(this).data('feedback-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this feedback?",
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
                url: '/delete-feedback',
                type: 'POST',
                data: { feedback_id: feedbackId },  
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
                        'An error occurred while deleting the feedback.',
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
$(document).on('click', '.deldetaillllll', function() {
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
                url: '/delete-detaill',
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

//to save customer message
$(document).ready(function () {
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();

         
        $('.text-danger').html('');

        $.ajax({
            url: "{{ route('submit.message') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire(
                        'Message Sent!',
                        'Our team will reach you shortly.',
                        'success'
                    );
                    $('#contactForm')[0].reset();  
                }
            },
            error: function (response) {
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
 
                    $.each(errors, function (field, message) {
                        $('#error-' + field).text(message[0]);
                    });

                    Swal.fire(
                        'Error!',
                        'Please correct the highlighted fields and try again.',
                        'error'
                    );
                }
            }
        });
    });
});


//to chng msg status
$(document).on('click', '.editstatus', function(e) {
    e.preventDefault();
    const messageId = $(this).data('message-id');

     Swal.fire({
        title: 'Are you sure?',
        text: "You want to mark this message as old?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/update-status",   
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",   
                    message_id: messageId   
                },
                success: function(response) {
                    if (response.success) {
                        
                        Swal.fire('Updated!', 'The status has been changed to Old.', 'success');

                
                        const statusTd = $(`a[data-message-id="${messageId}"]`).closest('tr').find('td.status');  
                        statusTd.html('<span style="background-color: red; color: white; padding: 13px 13px; border-radius: 50px; display: inline-block;">Old</span>'); // Change status to 'Old'

                         $(`a[data-message-id="${messageId}"]`).prop('disabled', true);
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                }
            });
        }
    });
});


//to del message
$(document).on('click', '.delmsg', function() {
    const msgId = $(this).data('message-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this message?",
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
                url: '/delete-message',
                type: 'POST',
                data: { message_id: msgId },  
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



//to open add setting model
$(document).ready(function() {
     $('.addsetting').click(function() {
         $('.custom-modal.setting').fadeIn();  
    });

     $('.closeModal').click(function() {
        $('.custom-modal.setting').fadeOut(); 
    });

     $(document).click(function(event) {
        if (!$(event.target).closest('.modal-content').length && !$(event.target).is('.addsetting')) {
            $('.custom-modal.setting').fadeOut(); 
        }
    });
});

//to del setting
$(document).on('click', '.delsetting', function() {
    const settingId = $(this).data('setting-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this setting?",
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
                url: '/delete-setting',
                type: 'POST',
                data: { setting_id: settingId },  
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
                        'An error occurred while deleting the setting.',
                        'error'
                    );
                }
            });
        }
    });
});
//to chnage password
$(document).on('click', '#submitpassword', function(e) {
 
 $('#passwordError').text('');
 $('#confirmPasswordError').text('');
 $('#message').html('');

 const password = document.getElementById('password').value;
 const confirmPassword = document.getElementById('confirm_password').value;

 $.ajax({
     url: '/changePassword',
     type: 'POST',
     data: {
         password: password,
         password_confirmation: confirmPassword
     },
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     success: function (response) {
         Swal.fire({
             icon: 'success',
             title: 'Success',
             text: response.message,
             confirmButtonText: 'OK'
         });
         $('#changePasswordForm')[0].reset();  
     },
     error: function (xhr) {
         if (xhr.status === 422) {
             const errors = xhr.responseJSON.errors;
             if (errors.password) {
                 $('#passwordError').text(errors.password[0]);
             }
             if (errors.password_confirmation) {
                 $('#confirmPasswordError').text(errors.password_confirmation[0]);
             }
         } else {
             Swal.fire({
                 icon: 'error',
                 title: 'Error',
                 text: 'An error occurred. Please try again.',
                 confirmButtonText: 'OK'
             });
         }
     }
 });
});


$(document).on('click', '.addtocartproduct', function (e) {
    e.preventDefault();

    var token = localStorage.getItem('token');

    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'You need to log in to add items to your cart.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    var productId = $(this).data('product-id');
    var optionId = $('#productSize').val();  
    var quantity = 1;  

    $.ajax({
        url: '/add-to-cart',
        type: 'POST',
        data: {
            product_id: productId,
            option_id: optionId,
            quantity: quantity,
            _token: $('meta[name="csrf-token"]').attr('content') 
        },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.message,
                confirmButtonText: 'OK'
            }).then(() => {
                 window.location.href = '/cart'; 
            });
        },
        error: function (xhr) {
            var errorMessage = xhr.responseJSON.message || 'An error occurred.';

            if (errorMessage === 'User not logged in.') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: errorMessage,
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '/login';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: errorMessage,
                    confirmButtonText: 'OK'
                });
            }
        }
    });
});

$(document).ready(function() {
    $('.update-quantity').on('click', function() {
        var action = $(this).data('action');  
        var cartItemId = $(this).data('id');
        var quantityInput = $('#quantity-' + cartItemId);
        var currentQuantity = parseInt(quantityInput.val());

        var newQuantity = action === 'increase' ? currentQuantity + 1 : currentQuantity - 1;
        
        if (newQuantity > 0) {
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    cart_item_id: cartItemId,
                    quantity: newQuantity
                },
                success: function(response) {
                     $('#quantity-' + cartItemId).val(response.newQuantity);
                     $('#total-' + cartItemId).text('Rs:' + response.newTotal);
                     $('#subtotal').text('Rs:' + response.newSubtotal);
                     $('#total-price').text('Rs:' + response.newTotalPrice);
                },
                error: function() {
                    alert('Error updating the quantity. Please try again.');
                }
            });
        }
    });
});




document.addEventListener('DOMContentLoaded', function() {
     const writeReviewBtn = document.getElementById('writeReviewBtn');
    if (writeReviewBtn) {
        writeReviewBtn.addEventListener('click', function() {
            var reviewForm = document.querySelector('.review-form');
            reviewForm.style.display = 'block';  
            setTimeout(function() {
                reviewForm.style.transform = 'translateY(0)';   
            }, 10);
        });
    }

     const cancelBtn = document.querySelector('.cancel-btn');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            var reviewForm = document.querySelector('.review-form');
            reviewForm.style.transform = 'translateY(-100%)';   
            setTimeout(function() {
                reviewForm.style.display = 'none';   
            }, 300);  
        });
    }

     document.querySelectorAll('.star').forEach(function(star) {
        star.addEventListener('click', function() {
            var rating = this.getAttribute('for').replace('star', '');  
            document.querySelectorAll('.star').forEach(function(s) {
                s.style.color = s.getAttribute('for').replace('star', '') <= rating ? 'yellow' : '#ccc';
            });
        });
    });
});


$(document).on('click', '#writeReviewBtn', function() {
     $(".review-form").css("transform", "translateY(0)");  
    $(".review-form").fadeIn();
});

$(document).on('click', '#submitReviewBtn', function(e) {
    e.preventDefault();
     var productId = $("#writeReviewBtn").data('product-id');
    
     var rating = $("input[name='rating']:checked").val();
    var reviewTitle = $("#reviewTitle").val();
    var reviewerName = $("#reviewerName").val();
    var reviewerEmail = $("#reviewerEmail").val();
    var messageReview = $("#reviewText").val();
    
     if (!rating || !reviewTitle || !reviewerName || !reviewerEmail || !messageReview) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please fill in all fields.',
        });
        return;
    }

     $.ajax({
        url: '/save-review',  
        method: 'POST',
        data: {
            product_id: productId,
            rating: rating,
            review_title: reviewTitle,
            name: reviewerName,
            email: reviewerEmail,
            message_review: messageReview,
            _token: $('meta[name="csrf-token"]').attr('content')  
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Review submitted successfully!',
            }).then(function() {
                 $("#reviewTitle").val('');
                $("#reviewerName").val('');
                $("#reviewerEmail").val('');
                $("#reviewText").val('');
                
                 $(".review-form").fadeOut();
                $(".review-form").css("transform", "translateY(-100%)");
            });
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'There was an error submitting your review.',
            });
        }
    });
});

 $(document).on('click', '.cancel-btn', function() {
    $(".review-form").fadeOut();
    $(".review-form").css("transform", "translateY(-100%)");
});

$(document).on('click', '.remove-cart-item', function (e) {
    e.preventDefault();  
    const cartItemId = $(this).data('id');  
    const row = $(`#cart-item-${cartItemId}`);  

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/cart/remove/${cartItemId}`,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') 
                },
                success: function (response) {
                    if (response.status === 'success') {
                        row.remove();

                        $('#subtotal').text(`Rs:${response.newSubtotal}`);
                        $('#total-price').text(`Rs:${response.newTotalPrice}`);

                         if (response.cartEmpty) {
                            $('.checkout').hide();   
                            $('.cart-empty-message').show();  
                        }

                        Swal.fire({
                            title: 'Removed!',
                            text: 'The item has been removed from your cart.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message || 'Failed to remove the cart item.',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred. Please try again.',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
    });
});


//to place order
$('.placeorder').click(function (e) {
    e.preventDefault();

    let formData = {
    full_name: $('input[name="full_name"]').val(),
    last_name: $('input[name="last_name"]').val(),
    email: $('input[name="email"]').val(),
    phone_number: $('input[name="phone_number"]').val(),
    address: $('input[name="address"]').val(),
    postcode: $('input[name="post_code"]').val(),  
    city: $('input[name="city"]').val(),
    province: $('input[name="province"]').val(),
    payment: $('input[name="payment"]:checked').val(),
};


     $('.text-danger').text("");

    $.ajax({
        url: '/place-order',
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            Swal.fire({
                title: 'Order Placed!',
                text: 'Your order has been placed successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = "/";
            });
        },
        error: function (xhr) {
            if (xhr.status === 422) {   
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {
                    $('#error-' + key).text(messages[0]);
                });
            } else {
                alert('Order placement failed');
                console.error('Error:', xhr.responseText);
            }
        }
    });
});

//to cnfrm delivery status
$(document).on('click', '#dlvrycnfrm', function (e) {
    e.preventDefault();

    var orderId = $(this).data('order-id');

    
    Swal.fire({
        title: 'Confirm Delivery',
        text: "Are you sure you want to mark this order as delivered?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, mark as delivered!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
           
            $.ajax({
                url: '{{ route("order.deliveryConfirm") }}',
                type: 'POST',
                data: {
                    order_id: orderId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        
                        $('tr[data-order-id="' + orderId + '"] .status').text('completed');

                         
                        $('tr[data-order-id="' + orderId + '"] .btnhide').remove();  
                        $('tr[data-order-id="' + orderId + '"] td:eq(15)').append('<a class="btn btn-success mx-5 btnshow">Delivered</a>'); 

                        Swal.fire(
                            'Delivered!',
                            'The order status has been updated to completed.',
                            'success'
                        );
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    Swal.fire(
                        'Error!',
                        'An error occurred while updating the status.',
                        'error'
                    );
                }
            });
        }
    });
});


//to chng order status
$(document).on('click', '.editorderstatus', function(e) {
    e.preventDefault();
    const orderId = $(this).data('order-id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to mark this customer as active?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/updateorder-status",  
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    order_id: orderId
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Updated!', 'Customer status has been changed to Active.', 'success');

                         const statusTd = $(`a[data-order-id="${orderId}"]`).closest('tr').find('td.statuss');
                         statusTd.html('<span style="background-color: red; color: white; padding: 13px 13px; border-radius: 50px; display: inline-block;">Old</span>'); 

                        $(`a[data-order-id="${orderId}"]`).prop('disabled', true);
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                    console.error(xhr.responseText);
                }
            });
        }
    });
});


$('.terms').click(function () {
$.ajax({
    url:'/policies/terms-of-service',
    type: 'GET',
    success: function (response) {
        window.location.href ='/policies/terms-of-service';
         
    },
    error: function (xhr, status, error) {
        console.error('AJAX Error: ', status, error);
    }
});
});


$('.refund').click(function () {
$.ajax({
    url:'/policies/refund-policy',
    type: 'GET',
    success: function (response) {
        window.location.href ='/policies/refund-policy';
         
    },
    error: function (xhr, status, error) {
        console.error('AJAX Error: ', status, error);
    }
});
});



$('.shipping').click(function () {
$.ajax({
    url:'/policies/shipping-policy',
    type: 'GET',
    success: function (response) {
        window.location.href ='/policies/shipping-policy';
         
    },
    error: function (xhr, status, error) {
        console.error('AJAX Error: ', status, error);
    }
});
});


$('.privacyyyyyy').click(function () {
$.ajax({
    url:'/policies/privacy-policy',
    type: 'GET',
    success: function (response) {
        window.location.href ='/policies/privacy-policy';
         
    },
    error: function (xhr, status, error) {
        console.error('AJAX Error: ', status, error);
    }
});
});




//to open add privacy model
$(document).ready(function() {
     $('.addprivacy').click(function() {
         $('.custom-modal.privacy').fadeIn();  
    });

     $('.closeModal').click(function() {
        $('.custom-modal.privacy').fadeOut(); 
    });

     $(document).click(function(event) {
        if (!$(event.target).closest('.modal-content').length && !$(event.target).is('.addprivacy')) {
            $('.custom-modal.privacy').fadeOut(); 
        }
    });
});

//to del privacy
$(document).on('click', '.delprivacy', function() {
    const privacyId = $(this).data('privacy-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this policy?",
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
                url: '/delete-privacy',
                type: 'POST',
                data: { privacy_id: privacyId },  
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
                        'An error occurred while deleting the policy.',
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


//to del order
$(document).on('click', '.delorder', function (e) {
    e.preventDefault();

    var orderId = $(this).data('order-id');
 
    Swal.fire({
        title: 'Confirm Deletion',
        text: "Are you sure you want to delete this order?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("order.delete") }}', 
                type: 'POST',
                data: {
                    order_id: orderId,
                    _token: '{{ csrf_token() }}'  
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                        
                        $('tr[data-order-id="' + orderId + '"]').remove();
                    } else {
                        Swal.fire(
                            'Error!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    Swal.fire(
                        'Error!',
                        'An error occurred while deleting the order.',
                        'error'
                    );
                }
            });
        }
    });
});


//to open add blog model
$(document).ready(function() {
     $('.addblog').click(function() {
         $('.custom-modal.blog').fadeIn();  
    });

     $('.closeModal').click(function() {
        $('.custom-modal.blog').fadeOut(); 
    });

     $(document).click(function(event) {
        if (!$(event.target).closest('.modal-content').length && !$(event.target).is('.addblog')) {
            $('.custom-modal.blog').fadeOut(); 
        }
    });
});

//to del blog
$(document).on('click', '.delblog', function() {
    const blogId = $(this).data('blog-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this blog?",
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
                url: '/delete-blog',
                type: 'POST',
                data: { blog_id: blogId },  
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
                        'An error occurred while deleting the blog.',
                        'error'
                    );
                }
            });
        }
    });
});

//to add product to wishlist
$(document).on('click', '.add-to-wishlist a', function (e) {
    e.preventDefault();  
    
    let productId = $(this).data('product-id');
   

    var token = localStorage.getItem('token');

    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'You need to log in to add items to your wishlist.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/login';
        });
        return;  
    }

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '/wishlist/add',
        type: 'POST',
        data: {
            product_id: productId,
            _token: csrfToken,  
        },
        success: function (response) {
            if (response.status === 'success') {
                $('.wishlistpage span').text(response.wishlist_count);
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                });
            } else if (response.status === 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.message,
                });
            }
        },
        error: function (xhr) {
            if (xhr.status === 401) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Login Required',
                    text: 'Please log in to add products to your wishlist.',
                }).then(() => {
                    window.location.href = '/login';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred. Please try again.',
                });
            }
        },
    });
});



//to open add header model
$(document).ready(function() {
     $('.addheader').click(function() {
         $('.custom-modal.header').fadeIn();  
    });

     $('.closeModal').click(function() {
        $('.custom-modal.header').fadeOut(); 
    });

     $(document).click(function(event) {
        if (!$(event.target).closest('.modal-content').length && !$(event.target).is('.addheader')) {
            $('.custom-modal.header').fadeOut(); 
        }
    });
});

//to del header
$(document).on('click', '.delheader', function() {
    const headerId = $(this).data('header-id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const row = $(this).closest('tr');  

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this header?",
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
                url: '/delete-header',
                type: 'POST',
                data: { header_id: headerId },  
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
                        'An error occurred while deleting the header.',
                        'error'
                    );
                }
            });
        }
    });
});

$(document).ready(function() {
    $('.adminimg').on('click', function () {
        $('#imageInput').click(); 
    });

    $('#imageInput').on('change', function (e) {
        var formData = new FormData();
        var file = e.target.files[0]; 

        if (file) {
            formData.append('image', file); 
            formData.append('_token', '{{ csrf_token() }}');  

            $.ajax({
                url: '{{ route('user.uploadImage') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        $('.admin img').attr('src', response.imageUrl);

                        Swal.fire({
                            icon: 'success',
                            title: 'Image uploaded successfully!',
                            text: 'Your profile image has been updated.',
                            background: '#FFFFFF',
                            color: 'black',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#4caf50'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Image upload failed!',
                            text: 'Please try again.',
                            background: '#FFFFFF',
                            color: 'black',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#f44336'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error uploading image',
                        text: 'Please try again later.',
                        background: '#FFFFFF',
                        color: 'black',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#f44336'
                    });
                }
            });
        }
    });
});


</script>
</body>