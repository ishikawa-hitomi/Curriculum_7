<?php

Breadcrumbs::for('recipe.index', function ($trail) {
  $trail->push('ホーム', route('recipe.index'));
});

Breadcrumbs::for('recipe.show', function ($trail,$id) {
  $trail->parent('recipe.index');
  $trail->push('レシピ', route('recipe.show',['recipe'=>$id]));
});
Breadcrumbs::for('recipe.edit', function ($trail,$id) {
  $trail->parent('recipe.show',$id);
  $trail->push('投稿編集 / レシピ', route('recipe.edit',['recipe'=>$id]));
});
Breadcrumbs::for('ingredient.edit', function ($trail,$id) {
  $trail->parent('recipe.edit',$id);
  $trail->push('材料・分量', route('ingredient.edit',['recipe'=>$id]));
});
Breadcrumbs::for('step.edit', function ($trail,$id) {
  $trail->parent('ingredient.edit',$id);
  $trail->push('手順', route('step.edit',['recipe'=>$id]));
});
Breadcrumbs::for('recipe.delete_show', function ($trail,$id) {
  $trail->parent('recipe.show',$id);
  $trail->push('レシピ削除', route('recipe.delete_show',['recipe'=>$id]));
});
Breadcrumbs::for('comment.show', function ($trail,$id) {
  $trail->parent('recipe.show',$id);
  $trail->push('コメント一覧', route('comment.show',['recipe'=>$id]));
});
Breadcrumbs::for('comment_create', function ($trail,$id) {
  $prevurl=url()->previous();
  if(strpos($prevurl,"recipe/")){
    $trail->parent('recipe.show',$id);
  }else{
    $trail->parent('comment.show',$id);
  }
  $trail->push('コメント投稿', route('comment_create',['recipe'=>$id]));
});

Breadcrumbs::for('user.show', function ($trail,$id) {
  $trail->parent('recipe.index');
  if($id!=Auth::user()->id){
    $trail->push('ユーザーページ', route('user.show',['user'=>$id]));
  }else{
    $trail->push('マイページ', route('user.show',['user'=>$id]));
  }
});
Breadcrumbs::for('user.profile_edit', function ($trail,$id) {
  $trail->parent('user.show',$id);
  $trail->push('プロフィール情報編集', route('user.profile_edit',['user'=>$id]));
});
Breadcrumbs::for('user.edit', function ($trail,$id) {
  $trail->parent('user.show',$id);
  $trail->push('ユーザー情報編集', route('user.edit',['user'=>$id]));
});
Breadcrumbs::for('user.pass_edit', function ($trail,$id) {
  $trail->parent('user.edit',$id);
  $trail->push('パスワード変更', route('user.pass_edit',['user'=>$id]));
});
Breadcrumbs::for('user.delete_show', function ($trail,$id) {
  $trail->parent('user.edit',$id);
  $trail->push('アカウント削除', route('user.delete_show',['user'=>$id]));
});

Breadcrumbs::for('recipe.create', function ($trail) {
  $trail->parent('recipe.index');
  $trail->push('新規投稿 / レシピ', route('recipe.create'));
});
Breadcrumbs::for('ingredient.create', function ($trail) {
  $trail->parent('recipe.create');
  $trail->push('材料・分量', route('ingredient.create'));
});
Breadcrumbs::for('step.create', function ($trail) {
  $trail->parent('ingredient.create');
  $trail->push('手順', route('step.create'));
});

Breadcrumbs::for('inquiry.index', function ($trail) {
  $trail->parent('recipe.index');
  $trail->push('Q&A', route('inquiry.index'));
});
Breadcrumbs::for('inquiry.create', function ($trail) {
  $trail->parent('inquiry.index');
  $trail->push('お問い合せ', route('inquiry.create'));
});