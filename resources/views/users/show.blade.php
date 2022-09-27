@extends('layouts.layout')

@section('head')
@parent

@endsection

@section('title', $data['title'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper kanban">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h1>個人資料</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">使用者維護</a></li>
            <li class="breadcrumb-item active">{{ $data['user']['name'] }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- Main content -->
  <div class="px-3 pb-3 overflow-auto content">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              @if (!empty($data['user']['photofile']))
              <img class="profile-user-img img-fluid img-circle"
                src="{{ asset('/storage/images/'.$data['user']['photofile']) }}" alt="User profile picture">
              @else
              <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/dist/img/user4-128x128.jpg') }}"
                alt="User profile picture">
              @endif
            </div>

            <h3 class="text-center profile-username">{{ $data['user']['name'] }}</h3>

            <ul class="mb-3 list-group list-group-unbordered">
              <li class="list-group-item">
                <b>組別</b>
                <span class="float-right">
                  {{ $data['teams'][$data['user']['team']] }}
                </span>
              </li>
              <li class="list-group-item">
                <b>職稱</b>
                <span class="float-right">
                  {{ $data['role']['role'] }}
                </span>

              </li>
              <li class="list-group-item">
                <b>狀態</b>
                <span class="float-right">
                  @if ($data['user']['status'] == 1)
                  啟用
                  @else
                  停用
                  @endif
                </span>
              </li>
            </ul>
            @if (Auth::user()->role == 13)
            <a class="btn btn-primary btn-block" href="{{ route('users.edit', ['user'=> $data['user']['id'] ] ) }}">
              編輯
              <i class="fas fa-pencil-alt"></i>
            </a>
            @endif
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <form class="card">
          <div class="card-header">
            設定
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail" class="col-sm-2 col-form-label">信箱</label>
              <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail"
                  value="{{ $data['user']['email'] }}" placeholder="電子郵件" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label">姓名</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="inputName" value="{{ $data['user']['name'] }}"
                  placeholder="姓名" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputTel" class="col-sm-2 col-form-label">電話</label>
              <div class="col-sm-10">
                <input type="text" name="tel" class="form-control" id="inputTel" value="{{ $data['user']['tel'] }}"
                  placeholder="電話" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputTeam" class="col-sm-2 col-form-label">組別</label>
              <div class="col-sm-10">
                <select class="form-control" name="team" id="inputTeam" disabled>
                  <option value="">請選擇</option>
                  @foreach ($data['teams'] as $key => $team)
                  @if ($data['user']['team']==$key)
                  <option value="{{ $key }}" selected>{{ $team }}</option>
                  @else
                  <option value="{{ $key }}">{{ $team }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputRole" class="col-sm-2 col-form-label">職稱</label>
              <div class="col-sm-10">
                <select class="form-control" name="role" id="inputRole" disabled>
                  <option value="">請選擇</option>
                  @foreach ($data['roles'] as $role)
                  @if ($data['user']['role']==$role['id'])
                  <option value="{{ $role['id'] }}" selected>{{ $role['role'] }}</option>
                  @else
                  <option value="{{ $role['id'] }}">{{ $role['role'] }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputStatus" class="col-sm-2 col-form-label">狀態</label>
              <div class="col-sm-10">
                <select class="form-control" name="status" id="inputStatus" disabled>
                  @if ($data['user']['status'] == 0)
                  <option value="0" selected>停用</option>
                  <option value="1">啟用</option>
                  @else
                  <option value="0">停用</option>
                  <option value="1" selected>啟用</option>
                  @endif
                </select>
              </div>
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </form>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('footerScripts')
@parent

@endsection
