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
    <div class="card card-primary card-outline h-100">
      <div class="card-body">
        <form class="form-horizontal">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="topic">公告主題</label>
                <input type="text" id="topic" name="topic" class="form-control" value="{{ $data['bboard']['topic'] }}"
                  readonly>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="msg_date">公告時間</label>
                <input type="date" id="msg_date" name="msg_date" class="form-control"
                  value="{{ $data['bboard']['msg_date'] }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12">
              <div class="form-group">
                <label for="inputStatus">狀態</label>
                <select id="inputStatus" class="form-control custom-select" disabled>
                  @if ($data['bboard']['status']==1)
                  <option selected>顯示</option>
                  <option>隱藏</option>
                  @elseif ($data['bboard']['status']==2)
                  <option>顯示</option>
                  <option selected>隱藏</option>
                  @endif
                  <option>刪除</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="content">公告內容</label>
                <textarea id="content" name="content" class="form-control" readonly
                  rows="10">{{ $data['bboard']['content'] }}</textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
      @if (Auth::user()->role == 13)
      <!-- .card-footer -->
      <div class="card-footer">
        <a class="btn btn-outline-primary btn-block"
          href="{{ route('bboards.edit', ['bboard'=> $data['bboard']['id'] ] ) }}">
          編輯
          <i class="fas fa-pencil-alt"></i>
        </a>
      </div>
      <!-- /.card-footer -->
      @endif

    </div>
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

</script>
@endsection
