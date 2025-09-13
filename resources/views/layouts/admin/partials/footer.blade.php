<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 footer-copyright text-start">
                @if(!empty($settings->copyright_text))
                    <p class="mb-0"> {{ $settings->copyright_text }} </p>
                @else
                     <p class="mb-0">Copyright {{ date('Y') }} © {{ $settings->site_title ?? config('app.name') }} All rights reserved. {{config('app.developed_by')}}</p>
                @endif
            </div>
        </div>
    </div>
</footer>