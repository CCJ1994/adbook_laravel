@extends('layouts.layout')

@section('head')
@parent

@endsection

@section('title', $data['title'])

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper kanban">
  <!-- Main content -->
  <div class="p-3 content">
    <div class="card card-success h-100">
      <div class="card-header">
        <h3 class="card-title">
          {{ $data['title'] }}
        </h3>
      </div>
      <div class="p-3 overflow-auto card-body">
        @if ( !empty($data['bboard']))
        @foreach ( $data['bboard']['data'] as $key => $bboard)
        @if ($key == 0)
        <div class="card callout callout-danger">
          @else
          <div class="card callout callout-danger collapsed-card">
            @endif
            <div class="card-header">
              <h3 class="card-title">
                <span>發布日期：{{ $bboard['msg_date'] }}</span>
                <span>{{ $bboard['topic'] }}</span>
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  @if ($key == 0)
                  <i class="fas fa-minus"></i>
                  @else
                  <i class="fas fa-plus"></i>
                  @endif
                </button>
              </div>
            </div>
            <div class="card-body">
              {!! $bboard['content'] !!}
            </div>
          </div>
          @endforeach
          <div class="card-tools">
            <ul class="pagination justify-content-center">
              @foreach ($data['bboard']['links'] as $page)
              @if ( $page['label']=='pagination.previous' && !empty($page['url']) )
              <li class="page-item"><a href="{{ $page['url'] }}" class="page-link">&laquo;</a></li>
              @elseif ( $page['label']=='pagination.next' && !empty($page['url']) )
              <li class="page-item"><a href="{{ $page['url'] }}" class="page-link">&raquo;</a></li>
              @elseif ( is_numeric($page['label']) )
              <li class="page-item"><a href="{{ $page['url'] }}" class="page-link">{{ $page['label'] }}</a></li>
              @endif
              @endforeach
            </ul>
          </div>
          @else
          目前無公告
          @endif

        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection

  @section('scripts')
  @parent

  @endsection
