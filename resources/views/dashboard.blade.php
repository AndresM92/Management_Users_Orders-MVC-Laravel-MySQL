@extends('layaout.app')
@section('contenido')
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Dashboard</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (Session::has('mensaje'))
                            <div class="alert alert-info alert-dimissible fade show mt-2">
                                {{Session::get('mensaje')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                            </div>
                            
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById("mnDasboard").classList.add('active');
    </script>
@endpush
