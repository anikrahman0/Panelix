<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 footer-copyright text-start">
                {{-- <p class="mb-0">Copyright {{ date('Y') }} © Panelix All rights reserved.</p> --}}
                @if(!empty($settings->copyright_text))
                    <p class="mb-0"> {{ $settings->copyright_text }} </p>
                @else
                     <p class="mb-0">Copyright {{ date('Y') }} © Panelix All rights reserved.Developed by Anik Rahman.</p>
                @endif
            </div>
            {{-- <div class="col-md-6 pull-right text-end">
                <p class=" mb-0">Hand crafted & made with<i class="fa fa-heart"></i></p>
            </div> --}}
        </div>
    </div>
</footer>