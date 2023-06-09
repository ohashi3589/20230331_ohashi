<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <title>Document</title>
</head>

<body style="background-color: #2d197c;">
  <div class="todo">
    <h2 style="color: black; text-align: left;">Todo List</h2>
    <div class="user-info">
      @auth
      <p>「{{ Auth::user()->name }}」でログイン中</p>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-logout">ログアウト</button>
      </form>
      @endauth
    </div>
    <a href="{{ route('find.index') }}" class="btn-search">タスク検索</a>
    <form method="POST" action="{{ route('store') }}">
      @csrf
      <div class="between">
        @if($errors->has('content'))
        <div style="color: black; font-size: medium;">
          {{ $errors->first('content') }}
        </div>
        <br>
        @endif
        <div style="position: relative;">
          <div style="display: inline-block; width: 80%; margin-right: 5%;">
            <input name="content" type="text" class="input-add" style="width: 100%;">
          </div>
          <div style="display: inline-block; width: 10%; ">
            <select name="tag" class="input-add" style="width: 100%;">
              <option value="家事">家事</option>
              <option value="勉強">勉強</option>
              <option value="運動">運動</option>
              <option value="食事">食事</option>
              <option value="移動">移動</option>
            </select>
          </div>
          <div style="display: inline-block;">
            <button type="submit" class="button-add">追加</button>
          </div>
        </div>
      </div>
    </form>
    <table>
      <tr>
        <th>登録日</th>
        <th>タスク名</th>
        <th>タグ</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
      @foreach ($todos as $todo)
      <tr>
        <td>{{ $todo->created_at }}</td>
        <td>
          <form action="{{ route('update', $todo->id) }}" method="POST">
            @csrf
            <input name="_method" type="hidden" value="POST">
            <input name="content" type="text" class="input-edit" value="{{ $todo->content }}">
        </td>
        <td>
          <select name="tag" class="input-edit" style="width: 100%;">
            <option value="火事" {{ $todo->tag == '家事' ? 'selected' : '' }}>家事</option>
            <option value="勉強" {{ $todo->tag == '勉強' ? 'selected' : '' }}>勉強</option>
            <option value="運動" {{ $todo->tag == '運動' ? 'selected' : '' }}>運動</option>
            <option value="食事" {{ $todo->tag == '食事' ? 'selected' : '' }}>食事</option>
            <option value="移動" {{ $todo->tag == '移動' ? 'selected' : '' }}>移動</option>
          </select>
        </td>
        <td>
          <button type="submit" class="button-edit">更新</button>
          </form>
        </td>
        <td>
          <form action="{{ route('delete', $todo->id) }}" method="POST">
            @csrf
            <input name="_method" type="hidden" value="POST">
            <button type="submit" class="button-danger">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>

</html>