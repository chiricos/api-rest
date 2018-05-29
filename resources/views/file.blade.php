<form action="/file" method="post" enctype="multipart/form-data" >
    <input type="file" name="file">
    <input type="text" name="name">
    {!! csrf_field() !!}

    <input type="submit" value="enviar">
</form>
<meta name="csrf-token" content="{{ csrf_token() }}">