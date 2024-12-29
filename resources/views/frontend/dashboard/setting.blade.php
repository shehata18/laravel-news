@extends('layouts.frontend.app')
@section( 'title' )
    Settings
@endsection
@section('body')
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img
                    src=" {{ asset($user->image) }}"
                    alt="User Image"
                    class="rounded-circle mb-2"
                    style="width: 80px; height: 80px; object-fit: cover"
                />
                <h5 class="mb-0" style="color: #ff6f61">{{ $user->name }}</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a
                    href="{{ route('frontend.dashboard.profile') }}"
                    class="list-group-item list-group-item-action menu-item"
                    data-section="profile"
                >
                    <i class="fas fa-user"></i> Profile
                </a>
                <a
                    href="{{ route('frontend.dashboard.notification') }}"
                    class="list-group-item list-group-item-action menu-item"
                    data-section="notifications"
                >
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a
                    href="{{ route('frontend.dashboard.setting') }}"
                    class="list-group-item list-group-item-action active menu-item"
                    data-section="settings"
                >
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Settings Section -->
            <section id="settings" class="content-section">
                <h2>Settings</h2>
                <form action="{{ route('frontend.dashboard.setting.update') }}" class="settings-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input name="name" type="text" id="name" value="{{ $user->name }}" />
                        @error( 'name' )
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input name="username" type="text" id="username" value="{{ $user->username }}" />
                        @error( 'username' )
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input name="email" type="email" id="email" value="{{ $user->email }}" placeholder="Enter Email" />
                        @error( 'email' )
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="profile-image">Profile Image:</label>
                        <input name="image" type="file" id="profile-image" accept="image/*" />
                        @error( 'image' )
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input
                            type="text"
                            id="country"
                            value="{{ $user->country }}"
                            placeholder="Enter your Country"
                            name="country"
                        />
                        @error( 'country' )
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input name="city" type="text" id="city" value="{{ $user->city }}" placeholder="Enter your City" />
                        @error( 'city' )
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input name="street" type="text" id="street" value="{{ $user->street }}" placeholder="Enter your Street"/>

                        @error( 'street' )
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="street">Phone:</label>
                        <input name="phone" type="text" id="phone" value="{{ $user->phone }}" placeholder="Enter your Phone"/>
                        @error( 'phone' )
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="save-settings-btn">
                        Save Changes
                    </button>
                </form>

                <!-- Form to change the password -->
                <form action="{{ route('frontend.dashboard.setting.changePassword') }}" class="change-password-form" method="post">
                    @csrf
                    <h2>Change Password</h2>
                    <div class="form-group">
                        <label for="current-password">Current Password:</label>
                        <div class="password-input-wrapper">
                            <input
                                type="password"
                                id="current-password"
                                placeholder="Enter Current Password"
                                name="current_password"
                            />
                            <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('current-password')"></i>
                        </div>
                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <div class="password-input-wrapper">
                            <input
                                type="password"
                                id="new-password"
                                placeholder="Enter New Password"
                                name="password"
                            />
                            <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('new-password')"></i>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password:</label>
                        <div class="password-input-wrapper">
                            <input
                                type="password"
                                id="confirm-password"
                                placeholder="Enter Confirm New "
                                name="password_confirmation"
                            />
                            <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('confirm-password')"></i>
                        </div>
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="change-password-btn">
                        Change Password
                    </button>
                </form>            </section>
        </div>
    </div>

    <!-- Dashboard End-->

    @push('js')
        <script>
            function togglePassword(inputId) {
                const passwordInput = document.getElementById(inputId);
                const icon = passwordInput.nextElementSibling;

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                } else {
                    passwordInput.type = "password";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                }
            }
        </script>
    @endpush

@endsection
