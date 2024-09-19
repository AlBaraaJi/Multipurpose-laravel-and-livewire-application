<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <div id="success-message" class="alert alert-success" style="display: none;">
        User added successfully!
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end">
                        <button wire:click.prevent="addNew" class="btn btn-primary mb-2">
                            <i class="fa fa-plus-circle mr-1"></i> Add New User
                        </button>

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th> <!-- Display row number -->
                                        <td>{{ $user->name }}</td> <!-- Display user's name -->
                                        <td>{{ $user->email }}</td> <!-- Display user's email -->
                                        <td>
                                            <a href="#">
                                                <i class="fa fa-edit mr-2" wire:click.prevent="edit({{$user}})"></i>
                                            </a>
                                            <a href="" wire:click.prevent="confirmUserRemoval({{$user->id}})">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{$showEditModal ? 'updateUser' : 'createUser'}}" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form">
                        @if($showEditModal)
                            <span>Edit User</span>
                        @else
                            <span>Add new User</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="Name">Name </label>
                            <input type="text"  wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror " id="name" aria-describedby="nameHelp" placeholder="Enter full name ">
                            @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" wire:model.defer="state.email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" wire:model.defer="state.password" id="password" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="passwordConfirmation" wire:model.defer="state.password_confirmation" placeholder="Confirm Password">

                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal"> <i class="nav-icon fas fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary nav-icon fas fa-save"> Save</button>
                </div>
            </div>
        </form>
        </div>
    </div>




<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5>Delete User</h5>
          </div>
          <div class="modal-body"> <h4> Are you sure you want to delete this user ? </h4></div>
          <div class="modal-footer">
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary " data-dismiss="modal"> <i class="nav-icon fas fa-times"></i> Cancel </button>
                  <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger nav-icon fas fa-trash-alt"> Delete </button>
              </div>
          </div>
      </div>
    </div>
</div>
</div>
