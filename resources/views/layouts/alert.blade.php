<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session()->has("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get("success") }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close">
                        <span>&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
