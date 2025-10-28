<div class="modal fade" id="modal-estado-{{ $reg->id }}" tabindex="-1" aria-labelledby="modal-estado-01Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-estado-{{ $reg->id }}Label">Historial de {{ $reg->name_pet }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="white-space: pre-wrap; font-family: monospace;">
                    <p>{{ $reg->medical_history }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
