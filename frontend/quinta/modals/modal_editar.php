<div id="modal_editar" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="nombre" name="nombre" class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_registro" action="../../../backend/registros/quintas_registro_up.php" method="post" enctype="multipart/form-data">
                <div class="col-md-12 mb-3">
                    <div class="row">
                        <h5>Los campos opcionales están indicados con un recuadro en el lado derecho. Marque esta casilla si desea dejar el campo vacío.</h5>
                    </div>
                    <br>
                    <div class="row">
                        <!-- colonia -->
                        <div class="col-md-4 mb-3">
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <select id="colonia" name="colonia" class="form-control">
                                </select>
                            </div>
                        </div>

                        <!-- precio -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Indique el precio general. Si hay variaciones, especifíquelo en la información adicional.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="number" id="precio" name="precio" class="form-control" step="0.01"
                                    placeholder="Precio">
                                <label for="precio">Precio: $$$$</label>
                            </div>
                        </div>

                        <!-- horario_inicio -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Por favor, indique la hora de inicio del servicio.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="time" id="horario_inicio" name="horario_inicio" class="form-control">
                                <label for="horario_inicio">Horario de inicio:</label>
                                <input type="checkbox" id="check_horario_inicio" name="check_horario_inicio" class="ms-2">
                            </div>
                        </div>

                        <!-- horario_final -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Indique la hora de finalización del servicio.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="time" id="horario_final" name="horario_final" class="form-control">
                                <label for="horario_final">Horario de cierre:</label>
                                <input type="checkbox" id="check_horario_final" name="check_horario_final" class="ms-2">
                            </div>
                        </div>

                        <!-- dias -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Especifique los días en que el servicio está disponible.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <div class="dias_p">
                                    <input type="checkbox" id="all_dias" name="all_dias" class="ms-2" value="all" checked> Todos los días
                                    <input type="checkbox" id="dias" name="dias" class="ms-2"> Personalizado
                                    <div id="dias_div" style="display: none;">
                                        <input type="checkbox" id="L" name="dias[]" class="ms-2" value="L">L
                                        <input type="checkbox" id="M" name="dias[]" class="ms-2" value="M">M
                                        <input type="checkbox" id="MI" name="dias[]" class="ms-2" value="MI">MI
                                        <input type="checkbox" id="J" name="dias[]" class="ms-2" value="J">J
                                        <input type="checkbox" id="V" name="dias[]" class="ms-2" value="V">V
                                        <input type="checkbox" id="S" name="dias[]" class="ms-2" value="S">S
                                        <input type="checkbox" id="D" name="dias[]" class="ms-2" value="D">D
                                    </div>
                                </div>
                                <input type="checkbox" id="check_dias" name="check_dias" class="ms-2">
                            </div>
                        </div>

                        <!-- info_extra -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Proporcione cualquier comentario o información adicional relevante sobre el servicio.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="info_extra" name="info_extra" class="form-control"
                                    placeholder="Información Extra">
                                <label for="info_extra">Información adicional:</label>
                                <input type="checkbox" id="check_info_extra" name="check_info_extra" class="ms-2">
                            </div>
                        </div>

                        <!-- direccion -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Dirección requerida. Esta información debe ser extraída de Google Maps para que el localizador funcione correctamente.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="direccion" name="direccion" class="form-control"
                                    placeholder="Dirección Exacta">
                                <label for="direccion">Dirección Exacta:</label>
                                <input type="checkbox" id="check_direccion" name="check_direccion" class="ms-2">
                            </div>
                        </div>

                        <!-- numero -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Número de teléfono de contacto. Por favor, proporcione un número donde podamos comunicarnos fácilmente.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="numero" name="numero" class="form-control"
                                    placeholder="Número de contacto">
                                <label for="numero">Número:</label>
                                <input type="checkbox" id="check_numero" name="check_numero" class="ms-2">
                            </div>
                        </div>

                        <!-- whatsapp -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Número de WhatsApp. Indique el número donde se puede contactar a través de esta plataforma para mayor comodidad.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="whatsapp" name="whatsapp" class="form-control"
                                    placeholder="WhatsApp">
                                <label for="whatsapp">WhatsApp:</label>
                                <input type="checkbox" id="check_whatsapp" name="check_whatsapp" class="ms-2">
                            </div>
                        </div>

                        <!-- facebook -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Proporcione el enlace a su perfil de Facebook. Puede obtenerlo directamente desde la plataforma.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="facebook" name="facebook" class="form-control"
                                    placeholder="Facebook">
                                <label for="facebook">Facebook: (enlace de perfil)</label>
                                <input type="checkbox" id="check_facebook" name="check_facebook" class="ms-2">
                            </div>
                        </div>

                        <!-- instagram -->
                        <div class="col-md-4 mb-3">
                            <h6><i class="bi bi-info-circle"></i> Proporcione el enlace a su perfil de Instagram. Puede obtenerlo directamente desde la plataforma.</h6>
                            <div class="form-floating mb-3 d-flex align-items-center">
                                <input type="text" id="instagram" name="instagram" class="form-control"
                                    placeholder="Instagram">
                                <label for="instagram">Instagram: (enlace de perfil)</label>
                                <input type="checkbox" id="check_instagram" name="check_instagram" class="ms-2">
                                <input id="id_sub_cat" name="id_sub_cat" value="" type="hidden">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-info">Publicar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelButton">Cancelar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
