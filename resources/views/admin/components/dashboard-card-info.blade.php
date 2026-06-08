<div class="col-lg-6 col-xl-3">
    <div class="card border-whi">
        <div class="card-body">
            <a href="{{ $route }}">
                <div class="row">
                    <div class="col-3">
                        <i class="avatar-md mdi {{ $icon }} font-48 text-muted"></i>
                    </div>
                    <div class="col-9">
                        <div class="text-end">
                            <h3 class="text-dark my-1"><span data-plugin="counterup">{{$count}}</span></h3>
                            <p class="text-muted mb-0">{{ $title }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div> <!-- end card-->
</div>