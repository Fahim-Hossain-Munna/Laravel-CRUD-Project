<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Insert Project</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">weXpart</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " href="{{ url("/") }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url("about") }}">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ url("contact") }}">Contact</a>
          </li>


    </div>
  </div>
</nav>

<div class="container">
<div class="one" style="margin-top: 50px;">
<div class="spinner-grow text-primary" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-secondary" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-success" role="status">
  <span class="visually-hidden">Loading...</span>
</div>

</div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-header">
                    Please Enter Your Informations,
                </div>
                <div class="card-body">
                    @if (session('info success'))
                        <div class="alert alert-success">
                            {{ session('info success')}}
                        </div>
                    @endif

                    <form action="{{ url('contact/insert') }}" method="POST">
                        @csrf

                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text"
                          class="form-control" name="name">
                          @if ($errors->first('name'))
                              <p class="text-danger m-2">{{ $errors->first('name') }}</p>
                          @endif
                      </div>
                      <div class="mb-3">
                        <label for="" class="form-label">Phone Number</label>
                        <input type="number"
                          class="form-control" name="phone_number" id="" aria-describedby="helpId" placeholder="">
                          @if ($errors->first('phone_number'))
                              <p class="text-danger m-2">{{ $errors->first('phone_number') }}</p>
                          @endif
                      </div>
                      <div class="mb-3">
                        <label for="" class="form-label">Age</label>
                        <input type="number"
                          class="form-control" name="age" id="" aria-describedby="helpId" placeholder="">
                          @if ($errors->first('age'))
                              <p class="text-danger m-2">{{ $errors->first('age') }}</p>
                          @endif
                      </div>
                      <div class="mb-3">
                        <label for="" class="form-label">E-mail</label>
                        <input type="email"
                          class="form-control" name="email" id="" aria-describedby="helpId" placeholder="">
                          @if ($errors->first('email'))
                              <p class="text-danger m-2">{{ $errors->first('email') }}</p>
                          @endif
                      </div>
                      <button class="btn btn-success" type="submit">Submit
                      </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row mt-5">
        <div class="col m-auto">
            <div class="card" style="margin-bottom: 100px">
                <div class="card-header">
                    Total Register Members, <span class="badge bg-primary">{{ $contacts_all_user }}</span>
                </div>
                <div class="card-body">
                    @if (session('info delete'))
                    <div class="alert alert-success">
                        {{ session('info delete')}}
                    </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Age</th>
                                <th>E-mail Address</th>
                                <th>Account Open_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                            <tr class="@if ($loop->odd)
                                table-danger
                                @else
                                table-warning
                            @endif">
                                <td>{{ $contacts->firstitem() + $loop->index }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->phone_number }}</td>
                                <td>{{ $contact->age }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->created_at->diffForHumans() }}</td>
                                <td> <a href="{{ url('contact/delete') }}/{{ $contact->id}}" class="btn btn-danger btn-sm">Delete</a>
                                    {{-- <a href="{{ url('contact/edit') }}/{{ $contact->id}}" class="btn btn-primary btn-sm">Edit</a> --}}
                                     <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $contact->id}}">
                                    Edit
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $contact->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Members,({{ $contact->name }})</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ url('contact/edit/post') }}/{{ $contact->id}}" method="POST">
                                            @csrf
                                        <div class="modal-body">
                                            {{-- start --}}



                                            <div class="mb-3">
                                                <label for="" class="form-label">Name</label>
                                                <input type="text"
                                                  class="form-control" name="name" value="{{ $contact->name }}">
                                                  @if ($errors->first('name'))
                                                      <p class="text-danger m-2">{{ $errors->first('name') }}</p>
                                                  @endif
                                              </div>
                                              <div class="mb-3">
                                                <label for="" class="form-label">Phone Number</label>
                                                <input type="number"
                                                  class="form-control" name="phone_number" id="" aria-describedby="helpId" value="{{ $contact->phone_number }}">
                                                  @if ($errors->first('phone_number'))
                                                      <p class="text-danger m-2">{{ $errors->first('phone_number') }}</p>
                                                  @endif
                                              </div>
                                              <div class="mb-3">
                                                <label for="" class="form-label">Age</label>
                                                <input type="number"
                                                  class="form-control" name="age" id="" aria-describedby="helpId" value="{{ $contact->age }}">
                                                  @if ($errors->first('age'))
                                                      <p class="text-danger m-2">{{ $errors->first('age') }}</p>
                                                  @endif
                                              </div>
                                              <div class="mb-3">
                                                <label for="" class="form-label">E-mail</label>
                                                <input type="email"
                                                  class="form-control" name="email" id="" aria-describedby="helpId" value="{{ $contact->email }}">
                                                  @if ($errors->first('email'))
                                                      <p class="text-danger m-2">{{ $errors->first('email') }}</p>
                                                  @endif
                                              </div>


                                            {{-- end --}}
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                                                                       {{-- modal start --}}
                                    <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Recycle Bin
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Restore Trashed,</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <table class="table table-hover table-bordered">
                                                        <thead>
                                                            <tr>
                                                              <th scope="col">SL No,</th>
                                                              <th scope="col">ID</th>
                                                              <th scope="col">Name</th>
                                                              <th scope="col">Phone Number</th>
                                                              <th scope="col">Action</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                           @foreach ($deleted_items as $item)
                                                             <tr>
                                                               <th scope="row"> {{ $loop->index + 1 }} </th>
                                                               <th scope="row"> {{ $item->id }} </th>
                                                               <td> {{ $item->name }}  </td>
                                                               <td> {{ $item->phone_number }}  </td>
                                                               <td> <a href="{{ url('contact/restore') }}/{{ $item->id}}" class="btn btn-warning btn-sm">Restore</a> </td>
                                                             </tr>
                                                           @endforeach
                                                      </table>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="{{ url('contact/delete_all')}}/all" class="btn btn-danger">Reset All Data</a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                   {{-- modal end --}}
                                </td>
                            </tr>
                            @endforeach
                            @if ($contacts->count() == 0)
                                <tr class="text-center text-danger">
                                    <td colspan="50">No Data Found</td>
                                </tr>
                        @endif
                        </tbody>
                    </table>
                    <a href="{{ url('contact/delete')}}/all" class="btn btn-warning">Delete All</a>

                    <div class="one mt-3 d-flex justify-content-center">{{ $contacts->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


  </body>
</html>
