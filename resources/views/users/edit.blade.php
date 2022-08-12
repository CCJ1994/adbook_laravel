@extends('layouts.layout')

@section('head')
@parent
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
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
    </div> <!-- /.container-fluid -->
  </div> <!-- Main content -->
  <div class="px-3 pb-3 overflow-auto content ">
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
                  {{ $data['role'] }}
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
            <a class="btn btn-secondary btn-block" href="{{ route('users.show', ['user'=> $data['user']['id'] ] ) }}">
              取消
              <i class="fas fa-ban"> </i>
            </a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <form class="card" action="{{ route('users.update',['user'=>$data['user']['id']]) }}" method="post"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-header">
            設定
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label">姓名</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="inputName" value="{{ $data['user']['name'] }}"
                  placeholder="姓名">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail" class="col-sm-2 col-form-label">信箱</label>
              <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail"
                  value="{{ $data['user']['email'] }}" placeholder="電子郵件">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputTel" class="col-sm-2 col-form-label">電話</label>
              <div class="col-sm-10">
                <input type="text" name="tel" class="form-control" id="inputTel" value="{{ $data['user']['tel'] }}"
                  placeholder="電話">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputTeam" class="col-sm-2 col-form-label">組別</label>
              <div class="col-sm-10">
                <select class="form-control" name="team" id="inputTeam">
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
                <select class="form-control" name="role" id="inputRole">
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
                <select class="form-control" name="status" id="inputStatus">
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
            <div class="form-group row">
              <label for="inputFile" class="col-sm-2 col-form-label">照片</label>
              <div class="col-sm-10">
                <input type="file" name="photofile" class="form-control-file" id="inputFile">
              </div>
            </div>
            <!-- <div class="form-group row">
                     <div class="offset-sm-2 col-sm-10">
                       <div class="checkbox">
                         <label>
                           <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                         </label>
                       </div>
                     </div>
                   </div> -->
                </div> <!-- /.card-body -->
                <div class="text-right card-footer">
                  <button type="submit" class="btn btn-danger">修改</button>
                </div>
        </form> <!-- /.card -->
      </div> <!-- /.col -->
    </div> <!-- /.row -->
  </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@php
$errorStr='';
if($errors->any()){
foreach($errors->all() as $error){
$errorStr .= $error.'\r';
}
}
@endphp

@endsection

@section('scripts')
@parent
<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
let teamsAry = <?=json_encode($data['teams']);?>;
let rolesAry = <?=json_encode($data['roles']);?>;

$(document).ready(function() {
  $("select[name='team']").change(function() {
    let team = $("select[name='team']").val();
    $("select[name='role']").html("");
    if (team != "") {
      if (team == 1) { //無組別
        Object.entries(rolesAry).forEach(([key, value]) => {
          if (value.id >= 9) {
            $("select[name='role']").append($('<option>', {
              value: value.id,
              text: value.role
            }));
          }
        });
      } else if (team == 2) { //策略中心
        Object.entries(rolesAry).forEach(([key, value]) => {
          if (value.id >= 5 && value.id <= 8) {
            $("select[name='role']").append($('<option>', {
              value: value.id,
              text: value.role
            }));
          }
        });
      } else {
        Object.entries(rolesAry).forEach(([key, value]) => {
          if (value.multiple == "Y") {
            $("select[name='role']").append($('<option>', {
              value: value.id,
              text: value.role
            }));
          }
        });
      }
    } else {
      $("select[name='role']").append($('<option>', {
        value: "",
        text: "請選擇"
      }));
    }
  });
});
//error message
var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000
});
var errMsg = "";
var hasErr = '<?=$errors->any();?>';
let errStr = "";
if (hasErr) {
  let errors = <?=json_encode($errors->all())?>;
  errStr = '<ul class="mt-3 text-sm list-disc list-inside text-danger">';
  errors.forEach(element => {
    errStr += '<li>' + element + '</li>';
  });
  errStr += '</ul>';
  Toast.fire({
    icon: 'error',
    title: errStr
  })
}
</script>
@endsection
