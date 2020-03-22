Producto seleccionado: cantidad y tipo

<p>Precio: 14,50 &euro; seleccionado</p>
<p>
Seleccione el tipo de acabado:
{!! Form::select('acabado',['brillo'=>'Brillo','mate'=>'Mate'],null,['placeholder'=>'','class'=>'form-control']) !!}
</p>
<p>
&iquest;Cual es tu urgencia?:
    <select name="urgencia" class="form-control" required>
        <option value="0">Normal (Gratis)</option>
        <option value="1">Urgente (4,95 &euro;)</option>
    </select>
</p>
<p>
&iquest;Desea dise&ntilde;o gr&aacute;fico?:
<select name="diseno" class="form-control" required>
    <option value="no">No, dispongo de mi propio dise&ntilde;o</option>
    <option value="una">Si, deseo dise&ntilde;o de una cara (12 &euro;)</option>
    <option value="dos">Si, deseo dise&ntilde;o de dos caras (20 &euro;)</option>
</select>
</p>
subida de imagen
