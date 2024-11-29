@if (session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="{{ asset('images/favicon/favicon.ico') }}" class="rounded me-2" alt="Logo" width="20px" height="20px">
                <strong class="me-auto">$GOBI</strong>
                <small>Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                @php echo session('success'); @endphp
            </div>
        </div>
    </div>
@endif


@if (count($errors) > 0)
    @foreach ($errors->all() as $index => $error)
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <div id="errorToast{{ $index }}" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="{{ asset('images/favicon/favicon.ico') }}" class="rounded me-2" alt="Logo" width="20px" height="20px">
                    <strong class="me-auto">$GOBI</strong>
                    <small>Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    @php echo $error; @endphp
                </div>
            </div>
        </div>
    @endforeach
@endif

@if (session('error'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="{{ asset('images/favicon/favicon.ico') }}" class="rounded me-2" alt="Logo" width="20px" height="20px">
                <strong class="me-auto">$GOBI</strong>
                <small>Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                @php echo session('error'); @endphp
            </div>
        </div>
    </div>
@endif

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var option = {
                animation: true,
                delay: 5000 // Adjust delay as needed
            };

            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl, option).show();
            });
        });
    </script>
@endsection
