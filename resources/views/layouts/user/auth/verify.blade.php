@extends('layouts.frontend.base.app')
@section('title','User Email Verify')


@section('content')
<main>
    <section class="verify-email-page-area text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 m-auto">
                    @if (session('resent'))
                        <x-frontend.common.success message="Your verification link has been sent to your email address" />
                    @endif
                    <div class="verify-email-page-wrapper">
                        <form class="d-inline" method="POST" action="{{ route('email.verify.resend') }}">
                            @csrf
                            <div class="verification-linkBg">
                                <i class="fa-regular fa-circle-check"></i>
                            </div>
                            <h5>Verify Your Email</h5>
                            <p>Before proceeding, please check your email for a verification link.
                                        If you did not receive the email, </p>
                            <button type="submit" class="btn verifyBtn">click here to request another</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
