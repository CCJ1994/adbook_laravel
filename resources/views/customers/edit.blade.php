<!-- /.control-sidebar -->
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
          <h1>公告編輯</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('bboards.index') }}">公告清單</a></li>
            <li class="breadcrumb-item active">{{ $data['bboard']['topic'] }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- Main content -->
  <div class="pb-3 content">
    <form class="card card-primary card-outline h-100" method="post"
      action="{{ route('bboards.update',['bboard'=>$data['bboard']['id']]) }}">
      @csrf
      @method('PUT')
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="topic">公告主題</label>
              <input type="text" id="topic" name="topic" class="form-control" value="{{ $data['bboard']['topic'] }}">
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="form-group">
              <label for="msg_date">公告時間</label>
              <input type="date" id="msg_date" name="msg_date" class="form-control"
                value="{{ $data['bboard']['msg_date'] }}">
            </div>
          </div>
          <div class="col-lg-6 col-sm-12">
            <div class="form-group">
              <label for="inputStatus">狀態</label>
              <select id="inputStatus" name="status" class="form-control custom-select">
                @if ($data['bboard']['status']==1)
                <option value="1" selected>顯示</option>
                <option value="2">隱藏</option>
                @elseif ($data['bboard']['status']==2)
                <option value="1">顯示</option>
                <option value="2" selected>隱藏</option>
                @endif
                <option value="0">刪除</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label for="content">公告內容</label>
              <textarea id="content" name="content" class="form-control"
                rows="10">{{ $data['bboard']['content'] }}</textarea>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <!-- .card-footer -->
      <div class="card-footer">
        <a href="{{ route('bboards.show', ['bboard'=> $data['bboard']['id'] ] ) }}" class="btn btn-secondary">取消</a>
        <input type="submit" value="儲存" class="float-right btn btn-primary">
      </div>
      <!-- /.card-footer -->
    </form>
    <!-- /.card -->

  </div>
</div>
<!-- /.content-wrapper -->

@endsection

@section('scripts')
@parent
<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
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
