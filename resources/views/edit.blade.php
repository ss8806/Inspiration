@extends('layouts.app')

@section('title')
    内容
@endsection

@section('content')
    <div class="p-card--product">
        <div class="c-session">
            @if (session('status'))
                    <div class="c-alert" role="alert">
                        {{ session('status') }}
                    </div>
            @endif
        </div>

        <div class="p-card p-card__header">
            <p>アイディアを編集する</p>
        </div>

        <div class="p-card p-card__body">
            <form method="POST" action="{{ route('update',$idea->id) }}" class="p-form p-form__edit" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                {{-- アイディア --}}
                <div class="p-form p-form__group">
                    <label for="name" class="c-label">アイディア名</label>
                    <div class="c-input">
                        <input id="name" type="text" class="c-input__product @error('name') is-invalid @enderror" name="name" value="{{ old('name',$idea->name) }}" required autocomplete="name">
                        @error('name')
                            <div class="c-error" role="alert">
                            <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- アイディアの概要 --}}
                <div class="p-form p-form__group">
                    <label for="description" class="c-label">アイディアの概要</label>
                    <div class="c-textarea">                    
                        <textarea id="description" type="text" class="c-textarea__product @error('content') is-invalid @enderror" name="description" required autocomplete="description">{{ old('description', $idea->description) }}</textarea>
                        @error('description')
                            <div class="c-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>
                

                {{-- アイディアの内容 --}}
                <div class="p-form p-form__group">
                    <label for="content" class="c-label">アイディアの内容</label>
                    <div class="c-textarea">        
                        <textarea type="text" id="content" class="c-textarea__product @error('description') is-invalid @enderror" name="content" required autocomplete="content">{{ old('content', $idea->content) }}</textarea>
                        @error('content')
                        <div class="c-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>

                {{-- カテゴリ --}}
                <div class="c-form c-form__group">
                <label for="category" class="c-label">カテゴリ</label>
                    <div class="p-card__from--group">
                        <select id="category" name="category" class="custom-select form-control @error('category') is-invalid @enderror">                            
                        @foreach ($categories as $c_id => $c_name)
                            <option value="{{$idea->Category->id}}" style="display: none;">{{$idea->Category->name}}</option>
                            <option value="{{ $c_id }}" @if(old('category') == "$c_id") selected @endif> {{$c_name}} </option>
                        @endforeach
                        </select>
                        @error('category')
                            <div class="c-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- 販売価格 --}}
                <div class="p-card__from--group">
                <label for="price">販売価格</label>
                    <div class="p-card__from--group">
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $idea->price }}" required autocomplete="price">
                        @error('price')
                        <div class="c-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="c-btn c-btn__edit">編集する</button>
                
            </form>

            <form method="post" action="{{ route('delete', [$idea->id]) }}" class="p-form p-form__delete">
                @method('DELETE')
                @csrf
                <button type="submit" class="c-btn c-btn__delete" value="delete" onclick='return confirm("削除しますか？");'>
                    削除する
                </button>
            </form>
        </div>
    </div>

@endsection