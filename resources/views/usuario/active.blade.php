<div class="modal fade" id="modal-toggle-{{ $reg->id }}" tabindex="-1" aria-labelledby="modal-toggle-{{ $reg->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('usuarios.toggle',$reg)}}" method="post">
              @csrf
              @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-toggle-{{ $reg->id }}Label">{{$reg->activo ? 'Desactivar' : 'Activar'}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿ Desea {{$reg->activo ? 'desactivar' : 'activar'}} el registro {{$reg->name}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">{{$reg->activo ? 'Desactivar' : 'Activar'}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
