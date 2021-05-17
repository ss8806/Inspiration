{{ config('app.name') }}をご利用頂きありがとうございます。

<div>
    <p>{{$s_name}}様</p>   
</div>

<div>
    <P>投稿したアイディアが評価されました。</P>
</div>

<div class="content">
    <p>アイディア名: {{$idea_name}}</p>
    <p>価格: {{$price}}</p>
    <p>評価: {{$rates}}</p>
    <p>コメント: {{$comment}}</p>
</div>
