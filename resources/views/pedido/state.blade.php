<div class="modal fade" id="modal-estado-{{ $reg->id }}" tabindex="-1" aria-labelledby="modal-estado-01Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('pedidos.changeStateSend', $reg->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-estado-{{ $reg->id }}Label">Cambiar estado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Seleccione el nuevo estado</p>
                    <div class="form-group">
                        <select name="estado" class="form-control">
                            @can('pedido-anulate')
                                <option value="enviado">Enviado</option>
                                <option value="anulado">Anulado</option>
                            @endcan
                            @can('pedido-cancel')
                                <option value="cancelado">Cancelado</option>
                            @endcan
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cambiar</button>
                </div>
            </form>
        </div>
    </div>
</div>
