@extends('admin.layouts.master')
@section('title', 'category list page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change your password!</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#changePassword') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label  class="control-label mb-1">Old Password:</label>
                                    <input   name="oldPassword" placeholder="Old Password" class="form-control
                                        @if (session('notMatch'))
                                            is-invalid
                                        @endif
                                        @error('oldPassword')
                                        is-invalid
                                    @enderror">
                                    @error('oldPassword')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    @if (session('notMatch'))
                                    <div class="invalid-feedback">
                                        {{session('notMatch')}}
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">New Password:</label>
                                    <input id="cc-pament" name="newPassword" type="password" value="{{old('newPassword')}}"
                                        class="form-control @error('newPassword')
                                        is-invalid
                                    @enderror" aria-required="true" aria-invalid="false" placeholder="New password">
                                    @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Confirm Password:</label>
                                    <input id="cc-pament" name="confirmPassword" type="password" value="{{old('confirmPassword')}}"
                                        class="form-control @error('confirmPassword')
                                        is-invalid
                                    @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm Password">
                                    @error('confirmPassword')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa-solid fa-key"></i> <span id="payment-button-amount"> Change Password</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
