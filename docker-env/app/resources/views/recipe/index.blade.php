@extends('layouts.layout')
@section('content')
  @if(!empty($keyword)||!empty($from)||!empty($to)||!empty($tag))
    <div class="card border-light">
      <h4 class="card-title text-center">@if(!empty($keyword))"{{$keyword}}" @endif @if(!empty($from))"{{$from}}" @endif @if(!empty($to))"{{$to}}" @endif @if(!empty($tag))"{{$tags[$tag_name]['name']}}" @endifの検索結果</h4>
      <div class="card-body">
        @foreach($search_recipes as $recipe)
          <div class="card mb-3">
            <div class="row">
              <div class="col-sm-5">
                <a href="{{route('recipe.show',['recipe'=>$recipe['id']])}}" class="ratio ratio-4x3">
                  <img class="img-fluid h-100" style="object-fit: cover;" src="{{asset('storage/' . $recipe['main_image']) }}">
                </a>
              </div>
              <div class="col-sm-7">
                <div class="card-body">
                  <a href="{{route('recipe.show',['recipe'=>$recipe['id']])}}" class="nav-link link-dark">
                    <small>{{substr($recipe['created_at'],0,10)}}</small>
                    <h5 class="card-title">{{$recipe['display_title']}}</h5>
                    <p class="card-text">{{$recipe['memo']}}</P>
                  </a>
                  <a href="{{route('user.show',['user'=>$recipe['user_id']])}}" class="nav-link link-dark">
                    <div class="col-1">
                      <div class="ratio ratio-1x1">
                      @if(is_null($recipe['user']['icon']))
                        <img class="col-1 rounded-circle" style="object-fit: cover;" src="{{asset('download20231202123050.png') }}">
                      @else
                        <img class="col-1 rounded-circle" style="object-fit: cover;" src="{{asset('storage/' . $recipe['user']['icon']) }}">
                      @endif
                      </div>
                    </div>
                    {{$recipe['user']['name']}}
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="d-flex justify-content-center">
        {{ $search_recipes->appends(['keyword' => $keyword,'from' => $from,'to' => $to,'tags' => $tags])->onEachSide(2)->render() }}
      </div>
    </div>
  @else
    <div class="card border-light mb-5">
      <h4 class="card-title text-center">新着レシピ</h4>
      <div class="card-body">
        <div class="slider">
          @foreach($new_recipes as $recipe)
            <div class="card">
              <p class="text-center my-auto"><strong>{{substr($recipe['created_at'],0,10)}}</strong></p>
              <a href="{{(route('recipe.show',['recipe'=>$recipe['id']]))}}" class="ratio ratio-16x9"><img style="object-fit: cover;" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
              <div class="card-body">
                <a href="{{(route('recipe.show',['recipe'=>$recipe['id']]))}}" class="link-dark text-decoration-none">
                  <div>
                    <h5>{{$recipe['display_title']}}</h5>
                    {{count($recipe['likes'])}}&nbsp;<small>いいね</small>
                  </div>
                </a>
                <a href="{{(route('user.show',['user'=>$recipe['user_id']]))}}" class="link-dark text-decoration-none">
                <div>{{$recipe['user']['name']}}</div>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="card border-light mb-5">
      <h4 class="card-title text-center">いいねが多いレシピ</h4>
      <div class="card-body">
        <div class="slider">
          @foreach($good_recipes as $recipe)
            <div class="card">
              <p class="text-center my-auto"><strong>{{$loop->index+1}}位</strong></p>
              <a href="{{(route('recipe.show',['recipe'=>$recipe['id']]))}}" class="ratio ratio-16x9"><img style="object-fit: cover;" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
              <div class="card-body">
                <a href="{{(route('recipe.show',['recipe'=>$recipe['id']]))}}" class="link-dark text-decoration-none">
                  <div>
                    <h5>{{$recipe['display_title']}}</h5>
                    {{$recipe['count']}}&nbsp;<small>いいね</small>
                  </div>
                </a>
                <a href="{{(route('user.show',['user'=>$recipe['user_id']]))}}" class="link-dark text-decoration-none">
                <div>{{$recipe['user']['name']}}</div>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="card border-light mb-5">
      <h4 class="card-title text-center">コメント数が多いレシピ</h4>
      <div class="card-body">
        <div class="slider">
          @foreach($comment_recipes as $recipe)
            <div class="card">
              <p class="text-center"><strong>{{$loop->index+1}}位</strong></p>
              <a href="{{(route('recipe.show',['recipe'=>$recipe['id']]))}}" class="ratio ratio-16x9"><img style="object-fit: cover;" src="{{asset('storage/' . $recipe['main_image']) }}"></a>
              <div class="card-body">
                <a href="{{(route('recipe.show',['recipe'=>$recipe['id']]))}}" class="link-dark text-decoration-none">
                  <div>
                    <h5>{{$recipe['display_title']}}</h5>
                    {{$recipe['count']}}&nbsp;<small>コメント</small>
                  </div>
                </a>
                <a href="{{(route('user.show',['user'=>$recipe['user_id']]))}}" class="link-dark text-decoration-none">
                  <div>{{$recipe['user']['name']}}</div>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  @endif
  <div class="card border-light">
    <h4 class="card-title text-center">タグ一覧</h4>
    <div class="card-body">
      @foreach($tags as $tag)
      <form action="{{route('recipe.index')}}" method="GET" class="d-inline-flex">
      <input type="hidden" name="tag" value="{{$tag['id']}}">
        <input type="submit" value="{{$tag['name']}}" class="btn btn-primary btn-sm rounded-pill">
      </form>
      @endforeach
    </div>
  </div>
  <script>
    $('.slider').slick({
      speed: 800,
      dots: true,
      arrows: true,
      centerMode:true,
      centerPadding:"20%",
      prevArrow:'<img src="http://localhost/矢印アイコン　左4.png" class="slick-prev">',
      nextArrow:'<img src="http://localhost/矢印アイコン　右4.png" class="slick-next">',
    });
  </script>
@endsection