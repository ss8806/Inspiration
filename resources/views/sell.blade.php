@extends('layouts.app')

@section('title')
    アイディア投稿
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
            <p>アイディアを投稿する</p>
        </div>

        <div class="p-card p-card__body">
            <form method="POST" action="{{ route('sell') }}" class="p-from" enctype="multipart/form-data">
                @csrf

                {{-- アイディア --}}
                <div class="p-form p-form__group">
                    <label for="name" class="c-label">アイディア名</label>
                    <div class="c-input">
                        <input id="name" type="text" class="c-input__product @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">                        
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
                        <textarea id="description" class="c-textarea__product @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ old('description') }}</textarea>
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
                        <textarea id="content" class="c-textarea__product @error('content') is-invalid @enderror" name="content" required autocomplete="content">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="c-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- カテゴリ --}}
                <div class="p-form p-form__group">
                    <label for="category">カテゴリ</label>
                    <div class="c-select">
                        <select name="category" class="c-select__product @error('category') is-invalid @enderror">  
                            @foreach ($categories as $category)
                                <option value="" style="display: none;" >選択してください</option>
                                <option value="{{$category->id}}" @if( old('category') == "$category->id" )selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <div class="c-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                {{-- 販売価格 --}}
                <div class="p-form p-from__group">
                <label for="price" class="c-label" >販売価格</label>
                    <div class="c-input">
                        <input id="price" type="number" class="c-input__product @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">
                    </div>
                    @error('price')
                        <div class="c-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="p-form__group">
                    <button type="submit" class="c-btn">投稿する</button>
                </div>
            </form>
        </div>
    </div>
@endsection