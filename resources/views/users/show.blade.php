@extends('layouts.layout')

@section('head')
@parent

@endsection

@section('title', $data['name'])

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="mb-2">
        <h1>個人資料</h1>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
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
                <img class="profile-user-img img-fluid img-circle"
                  src="{{ asset('assets/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                @endif
              </div>

              <h3 class="text-center profile-username">{{ $data['user']['name'] }}</h3>

              <p class="text-center text-muted">{{ $data['user']['team']."/".$data['user']['role'] }}</p>

              <ul class="mb-3 list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="float-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="float-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="float-right">13,287</a>
                </li>
              </ul>
              @if ($data['user']['role']!=13)

              <a class="btn btn-primary btn-block" href="{{ route('users.edit', ['user'=> $data['user']['id'] ] ) }}">
                <i class="fas fa-pencil-alt">
                </i>
                Edit
              </a>
              @endif
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
              設定
            </div><!-- /.card-header -->
            <div class="card-body">
              <div id="settings">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">姓名</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" id="inputName"
                        value="{{ $data['user']['name'] }}" placeholder="姓名" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">信箱</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" id="inputEmail"
                        value="{{ $data['user']['email'] }}" placeholder="電子郵件" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputTel" class="col-sm-2 col-form-label">電話</label>
                    <div class="col-sm-10">
                      <input type="text" name="tel" class="form-control" id="inputTel"
                        value="{{ $data['user']['tel'] }}" placeholder="電話" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputTeam" class="col-sm-2 col-form-label">組別</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="team" id="inputTeam" disabled>
                        @if ($data['user']['team']=="")
                        <option value="" selected>請選擇</option>
                        @else
                        @foreach ($data['teams'] as $team)
                        @if ($data['user']['team']==$team)
                        <option value="{{ $team['id'] }}" selected>{{ $team['team'] }}</option>
                        @else
                        <option value="{{ $team['id'] }}">{{ $team['team'] }}</option>
                        @endif
                        @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputRole" class="col-sm-2 col-form-label">職稱</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="role" id="inputRole" disabled>
                        @if ($data['user']['role']=="")
                        <option value="">請選擇</option>
                        @endif
                        @foreach ($data['roles'] as $role)
                        @if ($data['user']['role']==$role)
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
                        @switch($data['user']['status'])
                        @case("")
                        <option value="" selected>請選擇</option>
                        <option value="0">停用</option>
                        <option value="1">啟用</option>
                        @break
                        @case(0)
                        <option value="">請選擇</option>
                        <option value="0" selected>停用</option>
                        <option value="1">啟用</option>
                        @break
                        @case(1)
                        <option value="">請選擇</option>
                        <option value="0">停用</option>
                        <option value="1" selected>啟用</option>
                        @break
                        @endswitch
                      </select>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('footerScripts')
@parent

@endsection