@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('inc.messages')
                    <button
                        class="btn btn-primary btn-lg"
                        data-toggle="modal"
                        data-target="#addModal"
                        type="button"
                        name="button">Add Bookmark </button>
                        <hr>
                        <h3>Bookmarks</h3>

                        @if(count($bookmarks)>0)
                            <ul class="list-group">
                              @foreach($bookmarks as $bookmark)
                                <li class="list-group-item clearfix">
                                  <a href="/{{$bookmark->link}}" target="_blank" style="position:absolute;top:30%;">{{$bookmark->name}} <span class="tag tag-default">{{$bookmark->description}}</span> </a>
                                  <span class="float-right button-group" >
                                      <button type="button" class="delete-bookmark btn btn-danger" data-id="{{$bookmark->id}}" name="button"> Delete</button>
                                  </span>

                                </li>

                              @endforeach
                            </ul>
                        @else
                            <div class="alert alert-danger">
                                    No bookmarks added
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="addModal" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Bookmark</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form class="" action="{{route('bookmarks.store')}}" method="post">
                  {{csrf_field()}}
                  <div class="form-group">
                      <label>Bookmark Name</label>
                      <input type="text" class="form-control" name="name" >
                  </div>
                  <div class="form-group">
                      <label>Bookmark URL</label>
                      <input type="text" class="form-control" name="url" >
                  </div>
                  <div class="form-group">
                      <label>Website Description</label>
                      <textarea type="text" class="form-control" name="description" ></textarea>
                  </div>
                  <input type="submit" name="submit" value="Submit" class="btn btn-success" >
            </form>
      </div>

    </div>
  </div>
</div>
@endsection
