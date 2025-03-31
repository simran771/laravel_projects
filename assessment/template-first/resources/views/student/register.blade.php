@extends('layouts.master')
 @section('content')


 <div class='app-content content' >
 <div class='content-wrapper'>
 <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form-center">Student Registration</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"  action="{{ route('student.store')}}" method="post">
                                            @csrf
                                            <div class="row justify-content-md-center">
                                                <div class="col-md-6">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label for="eventInput1">Full Name</label>
                                                            <input type="text" id="eventInput1" class="form-control" placeholder="name" name="name">
                                                            @error('Full Name') <span class="tex-danger">{{$message}}</span> @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="eventInput2">Address</label>
                                                            <input type="text" id="eventInput2" class="form-control" placeholder="address" name="address">
                                                            @error('Address') <span class="tex-danger">{{$message}}</span> @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="eventInput4">Email</label>
                                                            <input type="email" id="eventInput4" class="form-control" placeholder="email" name="email">
                                                            @error('Email') <span class="tex-danger">{{$message}}</span> @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="eventInput5">Contact Number</label>
                                                            <input type="tel" id="eventInput5" class="form-control" name="contact" placeholder="contact">
                                                            @error('Contact Number') <span class="tex-danger">{{$message}}</span> @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="eventInput5">Course</label>
                                                            <input type="tel" id="eventInput5" class="form-control" name="course" placeholder="course">
                                                            @error('Contact Number') <span class="tex-danger">{{$message}}</span> @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="eventInput5">Age</label>
                                                            <input type="tel" id="eventInput5" class="form-control" name="age" placeholder="age">
                                                            @error('Age') <span class="tex-danger">{{$message}}</span> @enderror
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions text-center">
                                                <button type="button" class="btn btn-warning mr-1">
                                                    <i class="ft-x"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                   </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
 @endSection
