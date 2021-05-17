<div class="p-panel__product">
    <table class="p-table p-table--product" >
        <tr class="p-table__border">
            <th class="p-table__border p-table__ws" >投稿者</th>
            <td class="p-table__left">
                @if (!empty($idea->seller->avatar_file_name))
                    <img src="https://backend0622.s3-ap-northeast-1.amazonaws.com/{{$idea->seller->avatar_file_name}}" class="c-avatar">
                    <!-- <img src="http://localhost:8888/Inspiration/storage/app/public/avatars/{{$idea->seller->avatar_file_name}}" class="c-avatar"> -->
                @else
                    <img src="/images/avatar-default.svg" class="c-avatar">
                @endif
                {{$idea->seller->name}}
            </td>
        </tr>
        <tr class="p-table__border">
            <th class="p-table__border p-table__ws">カテゴリー</th>
            <td class="p-table__left">{{$idea->Category->name}}</td>
        </tr>
        <tr class="p-table__border">
            <th class="p-table__border p-table__ws">概要</th>
            <td class="p-table__left">{{$idea->description}}</td>
        </tr>
        <tr class="p-table__border">
            <th class="p-table__border p-table__ws">内容</th>
            @if ($idea->seller_id === $user->id)
            <td class="p-table__left">{{$idea->content}}</td>
            @else
            <td class="p-table__left">購入すると閲覧できます</td>
            @endif
        </tr>
        <tr class="p-table__border">
            <th class="p-table__border p-table__ws">平均評価</th>
            <td class="p-table__left">{{number_format($idea->avg_rate,1)}}点</td>
        </tr>
    </table>

    <div class="c-price">
        <i class="fas fa-yen-sign"></i>
        <span>{{$idea->price}}</span>
    </div>
</div>


