Acabas de recibir una solicitud de presupuesto,<br/>
<b>{{$presupuesto->nombre}}</b> solicita presupuesto sobre <b>{{$producto}}</b>, escribió este comentario: <br/>
{{$presupuesto->comentario}}
<br/>
el {{date_format($presupuesto->created_at,'d-m-y')}} a las {{date_format($presupuesto->created_at,'H:i:s')}}
<br/>
