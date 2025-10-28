@extends('layaout.app')
@section('contenido')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Dashboard</h3>
                    </div>

                    <div class="card-body">
                        @if (Session::has('mensaje'))
                            <div class="alert alert-info alert-dimissible fade show mt-2"  id="alertss">
                                {{Session::get('mensaje')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                            </div>
                            
                        @endif
                    </div>

                    <div class="card-footer clearfix">
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById("mnDasboard").classList.add('active');
    </script>
@endpush
