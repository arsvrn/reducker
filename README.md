<h1 align="center">
  <img src="https://cdn-icons-png.flaticon.com/512/714/714024.png" width="128">
  <br>ReDUCKer</br>
</h1>
<a href="Тестовое задание DEV Junior.pdf"> Задание </a>
<br>
<br> Результат: Проект находиться в папке reducker </a>
<br>
<br>В проекте были иcпользованы:
<ul>
  <li>Laravel Framework 8.83.15</li>
  <li>CSS Framework Bootstrap</li>
  <li>JavaScript library jQuery</li>
  <li>Database MySQL</li>
</ul>
<br>Удалось достигнуть:
<ul>
  <li>Ввод любого оригинального URL-адрес в поле ввода</li>
  <li>ajax-запрос на сервер и получение уникального короткого URL-адрес</li>
  <li>Короткий URL-адрес отображается на странице как http://127.0.0.1:8000/abCdE</li>
  <li>Посетитель может скопировать короткий URL-адрес и повторить процесс с другой ссылкой</li>
</ul>
<br>Не удалось:
<ul>
  <li>Завернуть приложение со всеми зависимостями в Docker</li>
</ul>

Код роутеров:
```PHP
Route::post('/short', [ShortLinkController::class, 'generate']);
Route::get('{code}', [ShortLinkController::class, 'linkRedirect']);
```
Код контроллера:
```PHP
class ShortLinkController
{
    public function generate (Request $request)
    {
        if (!$request->link){
            return '';
        }
        $link = $request->link;
        $checkLink = ShortLink::where('link', $link)->first();
        if ($checkLink) {
            return $checkLink->code;
        }
        do {
            $code = Str::random(6);
        }
        while (ShortLink::where('code', $code)->first());
        ShortLink::create([
            'link' => $link,
            'code' => $code
        ]);
        return $code;
    }

    public function linkRedirect ($code)
    {
        $link = ShortLink::where('code', $code)->first();
        if ($link) {
            return redirect($link->link);
        } else {
            return redirect('/');
        }
    }
}
```
JS-скрипт запроса 
```js
<script>
    $(function() {
        $('#generate').on('click',function(){
            var link = $('#fLink').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/short',
                type: "POST",
                data: {link:link},
                success: function (data) {
                    $('#shLink').val('http://127.0.0.1:8000/'+data);
                },
                error: function (xhr, textStatus ) {
                    alert( [ xhr.status, textStatus ] );
                }
            });
        });
    });
</script>
```
