<!DOCTYPE html>
<html lang="ja">
    <head>
        <script charset="utf-8" src="https://static.line-scdn.net/liff/edge/2/sdk.js"> </script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css\liff.css">
        <link rel="stylesheet" href="resources/css/reset.css">
 {{--       <script src="https://unpkg.com/glottologist"></script> --}}
{{-- End LINE Tag Base Code --}}
<script>
(function(g,d,o){
  g._ltq=g._ltq||[];g._lt=g._lt||function(){g._ltq.push(arguments)};
  var h=location.protocol==='https:'?'https://d.line-scdn.net':'http://d.line-cdn.net';
  var s=d.createElement('script');s.async=1;
  s.src=o||h+'/n/line_tag/public/release/v1/lt.js';
  var t=d.getElementsByTagName('script')[0];t.parentNode.insertBefore(s,t);
    })(window, document);
_lt('init', {
  customerType: 'account',
  tagId: '9e0c25f0-1415-4693-bafd-2a6b5c9c7049'
});
_lt('send', 'pv', ['9e0c25f0-1415-4693-bafd-2a6b5c9c7049']);
</script>
<noscript>
  <img height="1" width="1" style="display:none"
       src="https://tr.line.me/tag.gif?c_t=lap&t_id=9e0c25f0-1415-4693-bafd-2a6b5c9c7049&e=pv&noscript=1" />
</noscript>

<script>
    _lt('send', 'cv', {
      type: 'Conversion'
    },['9e0c25f0-1415-4693-bafd-2a6b5c9c7049']);
    </script>
    {{-- End LINE TagCode --}}
        <title>WELCOME</title>
    </head>
<body>
    <script src="{{secure_asset('/js/getUsers.js') }}">
        alert(liff.getProfile());
    </script>
<p> Who are you</p>
<script>

    
</script>
<form method="GET">
    @csrf
    <button type="submit"  action="/user" >user</button>
</form>
<div class="note">

</div>
<div id="profileInfo">
    <div id="profilePictureDiv" class="profile-picture"></div>
    <div class="profile-info">
      {{--    <h1 glot-model="companyName"></h1> --}}
      {{--    <p glot-model="departmentName"></p> --}}
        <p id="displayNameF"></p>
        <p id="userIdProfileField"></p>
        <p id="statusMessageField"></p>
        <p>TEL:00-0000-0000</p>
        <p>FAX:00-0000-0001</p>
        <p>MAIL:meishi@example.co.jp</p>    
    </div>
</div>

</body>
    </html>
