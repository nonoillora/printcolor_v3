Acabas de recibir un nuevo mensaje de contacto,<br/>
<b>{{$contacto->nombre}}</b> escribió este comentario: <br/>
{{$contacto->mensaje}}
<br/>
el {{date_format($contacto->created_at,'d-m-y')}} a las {{date_format($contacto->created_at,'H:i:s')}}
<br/>
