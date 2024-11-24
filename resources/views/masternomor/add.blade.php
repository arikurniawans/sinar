@extends('layouts.apps')

@section('container-fluid')

<div class="row">
    <div class="card">
       <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
             <h4 class="card-title">{{$subtitle}}</h4>
          </div>
          <a href="{{route('masternomor.index')}}" class="btn btn-secondary ml-auto">Kembali</a>
       </div>
       <div class="card-body">
          <div class="employee-info">
             @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <strong>Error:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

             <form action="{{ route('masternomor.store') }}" method="POST">
                @csrf
                <div class="row">
                   <div class="form-group col-md-6">
                      <label class="form-label" for="nomor_induk">Nomor Induk Yayasan:<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" name="nomor_yayasan" placeholder="Nomor Induk Yayasan" required>
                   </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit Data</button>
             </form>
          </div>
       </div>
    </div>
 </div>

 @endsection
