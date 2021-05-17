{{-- 検索ボックス --}}
<div class="p-serch">
    <form class="p-form" method="GET" action="{{ route('idea.index') }}">           
        <div class="p-serch__group">
            <!-- 投稿日で検索 -->     
            <span>投稿日検索　　</span>
            <span class="u-br"><!-- レスポンシブで改行 --> 
            <input type="date" name="aboveday" class="c-input__day" value="{{$defaults['aboveday']}}" >
            <span>~</span>
            <input type="date" name="belowday" class="c-input__day" value="{{$defaults['belowday']}}" >
        </div>
        
        <div class="c-serch-group">
            <span>価格検索　　　</span>
            <span class="u-br"><!-- レスポンシブで改行 --> 
            <!-- 価格 以上で検索 -->
            <input type="number" name="aboveprice" class="c-input__price" value="{{$defaults['aboveprice']}}"  placeholder="価格検索 以上">
            <span>~</span>
            <!-- 価格 以下で検索 -->
            <input type="number" name="belowprice" class="c-input__price" value="{{$defaults['belowprice']}}" placeholder="価格検索 以下">
        </div>
        <div class="c-serch-group">
            <!-- カテゴリー検索 -->
            <!-- name="category"はクエリパラメータ category= -->
            <span>カテゴリー検索</span>
            <span class="u-br">
            <select class="c-select__category" name="category">
                <option value="">全てのカテゴリー</option>
                @foreach ($categories as $category)
                    <option value="c_id:{{$category->id}}" {{ $defaults['category'] == "c_id:" . $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                @endforeach
            </select>
            <!-- キーワード検索 -->
            <!-- <input type="text" name="keyword" class="f" value="{{$defaults['keyword']}}" aria-label="Text input with dropdown button" placeholder="キーワード検索"> -->

            <!-- 検索ボタン -->
            <button type="submit" class="c-btn c-btn__serch">
                <i class="fas fa-search"></i>
            </button>
        </div>        
    </form>
</div>