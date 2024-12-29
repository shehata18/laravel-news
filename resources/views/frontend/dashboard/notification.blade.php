@extends('layouts.frontend.app')
@section( 'title' )
    Profile
@endsection
@section('body')

    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{ asset(auth()->guard('web')->user()->image)}}" alt="User Image" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover" />
                <h5 class="mb-0" style="color: #ff6f61">{{ auth()->guard('web')->user()->name }}</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{ route('frontend.dashboard.profile') }}" class="list-group-item list-group-item-action menu-item" data-section="profile">
                    <i class="fas fa-user"></i> Profile </a>
                <a href="{{ route('frontend.dashboard.notification') }}" class="list-group-item list-group-item-action active menu-item" data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications </a>
                <a href="{{ route('frontend.dashboard.setting') }}" class="list-group-item list-group-item-action menu-item" data-section="settings">
                    <i class="fas fa-cog"></i> Settings </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h2 class="mb-4">Notifications</h2>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('frontend.dashboard.notifications.deleteAll') }}" style="margin-left: 270px;" class="btn btn-sm btn-danger">Delete all</a>
                    </div>
                </div>
                <!-- "Mark All as Read" Button -->
                <form action="{{ route('frontend.dashboard.notifications.markAllRead') }}" method="POST" class="mb-3 text-right">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">Mark All as Read</button>
                </form>

                @forelse( auth()->user()->notifications as $notify)
                    <a href="{{ route('frontend.dashboard.notifications.markAsRead', ['id' => $notify->id, 'redirect' => $notify->data['link']]) }}">
                        <div class="notification alert {{ $notify->read_at ? 'alert-secondary' : 'alert-info' }}">
                            <strong> You have a notification from {{ $notify->data['user_name'] }}
                            </strong> Post title: {{ $notify->data['post_title'] }}
                            <div class="float-right">
                                <button onclick="if(confirm('Are u sure to Delete this notification?')){ document.getElementById('deleteNotify').submit()} return false" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </a>
                    <form id="deleteNotify" action="{{ route('frontend.dashboard.notifications.delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="notify_id" value="{{ $notify->id }}">
                    </form>
                @empty
                    <div class="alert alert-info">
                       No notifications found
                    </div>

                @endforelse


            </div>
        </div>
    </div>
    <!-- Dashboard End-->

@endsection

