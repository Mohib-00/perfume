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


        
if ((window.location.pathname === '/admin' || window.location.pathname === '/admin/users') && !localStorage.getItem('token')) {
        window.location.href = '/';  
    }

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
</script>
</body>