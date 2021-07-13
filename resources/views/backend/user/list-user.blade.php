@extends('backend.template')
@section('title')
    {{$title}}
@endsection
@section('content')
<div class="container">
  <div class="main-title-wrapper">
    <h2 class="main-title">{{$pageTitle}}</h2>
    <a class="primary-default-btn" href="{{$btnRight['link']}}">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
      {{$btnRight['text']}}
    </a>
  </div>
  <div class="sort-bar">
    <div class="sort-bar-start col-md-2 offset-9">
      <form action="" method="get">
        <div class="search-wrapper">
          <input type="text" name="keyword" value="{{Request::get('keyword')}}" placeholder="Search" >
          <button type="submit" style="background-color: transparent">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
          </button>
        </div>

      </form>
    </div>
  </div>
  <div class="users-table table-wrapper">
    <table class="table-striped">
      <thead>
        <tr class="users-table-info">
          <th>
            <label class="users-table__checkbox ms-20">No
            </label>
          </th>
          <th>Nama</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php
            $page = Request::get('page');
            $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
        @endphp
        @foreach ($user as $item)
          <tr>
            <td>
              <label class="users-table__checkbox">{{$no}}</label></td>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>
              <span class="p-relative">
                <button class="dropdown-btn transparent-btn" type="button" title="More info">
                  <div class="sr-only">More info</div>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal" aria-hidden="true"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                </button>
                <ul class="users-item-dropdown dropdown">
                  <li><a href="https://dashboard.elegant-goodies.com/demo/users-01.html##">Edit</a></li>
                  <li><a href="https://dashboard.elegant-goodies.com/demo/users-01.html##">Quick edit</a></li>
                  <li><a href="https://dashboard.elegant-goodies.com/demo/users-01.html##">Trash</a></li>
                </ul>
              </span>
            </td>
          </tr>
          @php
              $no++;
          @endphp
        @endforeach
      </tbody>
    </table>
  </div>
  
    {{$user->appends(Request::all())->links('vendor.pagination.custom')}}
  
</div>
@endsection