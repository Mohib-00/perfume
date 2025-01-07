<footer class="footer_area clearfix" style="text-align: center;">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5 my-3">
                <div class="">
                    <div>
                        <h3 style="color:white">Contact</h3>
                    </div>
                </div>
                <div class="footer_menu">
                    <ul>
                        <li><a href="{{$settings->email}}" style="text-decoration: underline; font-size: 18px;">{{$settings->email}}</a></li>
                        <li><a href="{{$settings->number}}" style="text-decoration: underline; font-size: 18px;">{{$settings->number}}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-5 my-3">
                <div class="">
                    <div>
                        <h3 style="color:white">Get Connected</h3>
                    </div>
                </div>
                <div class="footer_social_area" style="margin-right:10px">
                    @if($settings->facebook)
                    <a  href="{{ $settings->facebook }}" data-toggle="tooltip" data-placement="top" title="Facebook" style="margin-right: 10px;">
                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" width="30" height="30"><path d="M14.1667 1.66663H11.6667C10.5616 1.66663 9.50179 2.10561 8.72039 2.88701C7.93899 3.66842 7.5 4.72822 7.5 5.83329V8.33329H5V11.6666H7.5V18.3333H10.8333V11.6666H13.3333L14.1667 8.33329H10.8333V5.83329C10.8333 5.61228 10.9211 5.40032 11.0774 5.24404C11.2337 5.08776 11.4457 4.99996 11.6667 4.99996H14.1667V1.66663Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </a>
                    @endif
                    @if($settings->instagram)
                    <a href="{{ $settings->instagram }}" data-toggle="tooltip" data-placement="top" title="Instagram" style="margin-right: 10px;">
                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" width="30" height="30"><path d="M6.33333 14.1667V8.33333M18 6.66667V13.3333C18 14.4384 17.561 15.4982 16.7796 16.2796C15.9982 17.061 14.9384 17.5 13.8333 17.5H7.16667C6.0616 17.5 5.00179 17.061 4.22039 16.2796C3.43899 15.4982 3 14.4384 3 13.3333V6.66667C3 5.5616 3.43899 4.50179 4.22039 3.72039C5.00179 2.93899 6.0616 2.5 7.16667 2.5H13.8333C14.9384 2.5 15.9982 2.93899 16.7796 3.72039C17.561 4.50179 18 5.5616 18 6.66667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9.66732 14.1667V11.4584M9.66732 11.4584V8.33335M9.66732 11.4584C9.66732 8.33335 14.6673 8.33335 14.6673 11.4584V14.1667M6.33398 5.84169L6.34232 5.83252" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </a>
                    @endif
                    @if($settings->twitter)
                    <a href="{{ $settings->twitter }}" data-toggle="tooltip" data-placement="top" title="Twitter" style="margin-right: 10px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15"/>
                        </svg>
                    </a>
                    @endif
                    @if($settings->youtube)
                    <a href="{{ $settings->youtube }}" data-toggle="tooltip" data-placement="top" title="YouTube" style="margin-right: 10px;">
                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" width="30" height="30"><path d="M12.1667 10L9.25 11.6667V8.33337L12.1667 10Z" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M2.16602 10.5892V9.41004C2.16602 6.99754 2.16602 5.79087 2.92018 5.01504C3.67518 4.23837 4.86352 4.20504 7.23935 4.13754C8.36435 4.10587 9.51435 4.08337 10.4993 4.08337C11.4835 4.08337 12.6335 4.10587 13.7593 4.13754C16.1352 4.20504 17.3235 4.23837 18.0777 5.01504C18.8327 5.79087 18.8327 6.99837 18.8327 9.41004V10.5892C18.8327 13.0025 18.8327 14.2084 18.0785 14.985C17.3235 15.7609 16.136 15.795 13.7593 15.8617C12.6343 15.8942 11.4843 15.9167 10.4993 15.9167C9.51518 15.9167 8.36518 15.8942 7.23935 15.8617C4.86352 15.795 3.67518 15.7617 2.92018 14.985C2.16602 14.2084 2.16602 13.0017 2.16602 10.59V10.5892Z" stroke="currentColor" stroke-width="1.5"></path></svg>
                    </a>
                    @endif
                    @if($settings->tiktok)
                    <a href="{{ $settings->tiktok }}" data-toggle="tooltip" data-placement="top" title="tiktok">
                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" width="30" height="30"><path d="M17.5 6.66667V13.3333C17.5 14.4384 17.061 15.4982 16.2796 16.2796C15.4982 17.061 14.4384 17.5 13.3333 17.5H6.66667C5.5616 17.5 4.50179 17.061 3.72039 16.2796C2.93899 15.4982 2.5 14.4384 2.5 13.3333V6.66667C2.5 5.5616 2.93899 4.50179 3.72039 3.72039C4.50179 2.93899 5.5616 2.5 6.66667 2.5H13.3333C14.4384 2.5 15.4982 2.93899 16.2796 3.72039C17.061 4.50179 17.5 5.5616 17.5 6.66667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M8.33399 10C7.83953 10 7.35618 10.1466 6.94506 10.4213C6.53394 10.696 6.21351 11.0865 6.02429 11.5433C5.83507 12.0001 5.78556 12.5028 5.88202 12.9877C5.97849 13.4727 6.21659 13.9181 6.56622 14.2678C6.91585 14.6174 7.36131 14.8555 7.84626 14.952C8.33121 15.0484 8.83388 14.9989 9.29069 14.8097C9.74751 14.6205 10.138 14.3 10.4127 13.8889C10.6874 13.4778 10.834 12.9945 10.834 12.5V5C11.1115 5.83333 12.1673 7.5 14.1673 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </a>
                    @endif
                </div>
                
            </div>

            <div class="col-12 col-md-2 my-3">
                <div class="footer_menu">
                    <ul style="list-style-type: none; padding: 0;">
                        <li class="home my-2" style="color:white;">Home page</li>
                        <li class="storypage my-2" style="color:white;">Our Story</li>
                        <li class="openblogs my-2" style="color:white;">Blogs</li>
                        <li class="terms my-2" style="color:white;">Terms of service</li>
                        <li class="refund my-2" style="color:white;">Refund Policy</li>
                        <li class="shipping my-2" style="color:white;">Shipping Policy</li>
                        <li class="privacyyyyyy my-2" style="color:white;">Privacy Policy</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <p>
                    &copy;<script>document.write(new Date().getFullYear());</script> Atir'z
                </p>
            </div>
        </div>
    </div>
</footer>
