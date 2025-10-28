<div class="modal fade" id="modal-eliminar-{{ $reg->id }}" tabindex="-1" aria-labelledby="modal-eliminar-01Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('mascotas.destroy',$reg->id)}}" method="post">
              @csrf
              @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-eliminar-{{ $reg->id }}Label">Eliminar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿ Desea eliminar el registro {{$reg->name_pet}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>