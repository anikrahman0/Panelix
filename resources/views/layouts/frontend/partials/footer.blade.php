<footer class="footer-one">
<div class="footer-one__bg">
</div>
<div class="footer-one__top">
<div class="container">
<div class="row">
<div class="col-lg-3 col-md-6 mb-4 d-flex justify-content-center align-items-center">
	<div class="logoWrap">
		<a class="FLogo" href="{{ route('frontend.index') }}">
			@if(!empty($settings->logo))
				<img class="img-fluid" src="{{ $cdn_url . '/' . $settings->logo }}" alt="Site Logo" title="Site Logo">
			@else
				<img class="img-fluid" src="{{ $cdn_url . '/' . config('app.default_logo') }}" alt="Site Logo" title="Site Logo">
			@endif
		</a>
		<div class="footer-content">
			<div class="FSocialLink">
				<ul>
					<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="#" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
					<li><a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
					<li><a href="#" target="blank"><i class="fa-brands fa-youtube"></i></a></li>
				</ul>
			</div>
	</div>
	</div>
</div>
<div class="col-lg-3 col-md-6 mb-4 d-flex justify-content-center">
	<div class="footer-content">
		<h2 class="Footer-Title">
		জনপ্রিয়
		</h2>
		<ul>
			@foreach($popular_categories as $popularCategory)
				<li><a href="{{ route('frontend.category', $popularCategory->slug) }}">{{ $popularCategory->title }}</a> </li>
			@endforeach
			{{-- <li><a href="">ফ্রিল্যান্সিং ও আউটসোর্সিং</a> </li>
			<li><a href="">প্রি-অর্ডার</a> </li>
			<li><a href="">পরিবেশ ও প্রকৃতি</a> </li>
			<li><a href="">রোযা/সিয়াম</a> </li>
			<li><a href="">রেসিপি</a> </li>
			<li><a href=""> ইলেক্ট্রনিক্স</a> </li>
			<li><a href="">ভ্রমণ গল্প</a> </li> --}}
		</ul>
	</div>
</div>
<div class="col-lg-3 col-md-6 mb-4 d-flex justify-content-center">
	<div class="footer-content">
		<h2 class="Footer-Title">
		প্রয়োজনীয় লিংক
		</h2>
		<ul>
			<li><a href="{{ route('frontend.about') }}"> আমাদের সম্পর্কে</a> </li>
			<li><a href="{{ route('frontend.contact') }}"> যোগাযোগ করুন</a> </li>
			<li><a href="{{ route('frontend.refund.policy') }}"> রিফান্ড নীতিমালা</a> </li>
			<li><a href="{{ route('frontend.privacy.policy') }}"> প্রাইভেসী পলিসি</a> </li>
			<li><a href="{{ route('frontend.terms.conditions') }}"> শর্তাবলী</a> </li>
		</ul>
	</div>
</div>
<div class="col-lg-3 col-md-6 mb-4 d-flex justify-content-center">
	<div class="footer-content">
		<h2 class=" Footer-Title">Contact us</h2>
		<div class="AddressInfo">
			<address>
				<p class="Address"><b>অফিস ঠিকানা:</b> <a href="#">{{ $settings->address ?? config('app.default_address') }}</a> </p>
			</address>
			<p class="Phone"><b>মোবাইল : </b> <a href="tel:{{ $settings->default_phone ?? config('app.default_phone') }}">{{ fEn2Bn($settings->default_phone ?? config('app.default_phone')) }}</a> </p>
			<p class="Email"><b>ইমেইল : </b> <a href="mailto:{{ $settings->default_email ?? config('app.default_email') }}">{{ $settings->default_email ?? config('app.default_email') }}</a></p>
		</div>
	</div>
</div>
</div>
</div>
<!--Start Footer One Bottom-->
<div class="footer-one__bottom">
<div class="container">
<div class="row">
	<div class="col-xl-12">
		<div class="footer-one__bottom-inner">
			<div class="footer-one__bottom-text">
				<p><span class="En">&copy;</span> {{ fEn2Bn(date("Y")) }} | {{ $settings->copyright_text ?? config('app.default_copyright') }} | উন্নয়নে<a href="https://www.emythmakers.com/" target="_blank"> ইমিথমেকারস.কম</a> </p>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<!--End Footer One Bottom-->
</footer>