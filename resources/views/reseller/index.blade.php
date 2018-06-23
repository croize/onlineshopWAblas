@extends('layouts.utama')

@section('title')
  Reseller Dashboard
@endsection

@section('content')
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <p style="font-size: 38px;font-weight: bold;">Rp. {{ number_format($deposit, 0, ',', ',') }}</p>

        <p>Pendapatan</p>
      </div>
      <div class="icon">
        <i class="fa fa-money"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{$order}} Order</h3>

        <p>Jumlah Order</p>
      </div>
      <div class="icon">
        <i class="fa fa-shopping-cart"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-purple">
      <div class="inner">
        <h3>{{$transaksi}} Transaksi</h3>

        <p>Transaksi Berhasil</p>
      </div>
      <div class="icon">
        <i class="fa fa-bank"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-maroon">
      <div class="inner">
        <h3>{{$barang}} Produk</h3>

        <p>Jumlah Produk</p>
      </div>
      <div class="icon">
        <i class="fa fa-tags"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
</div>



@if(Auth::user()->status_reseller == "0")
<div class="row">
  <div class="col-md-12">
    <div class="callout callout-warning">
      <h4>Anda belum bisa melakukan broadcast produk kami</h4>

      <p>Untuk mengaktifkan akun reseller Anda, silahkan melakukan pembayaran sebesar Rp. 100.000 dengan Virtual Account Bank kami.</p>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{url('assetdashboard/dist/img/Mobster Logo Fix-02.png')}}" alt="User profile picture">

        <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- About Me Box -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">About Me</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <strong><i class="fa fa-book margin-r-5"></i> Phone Number</strong>

        <p class="text-muted">
          +62 {{Auth::user()->no_hp}}
        </p>

        <hr>

        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

        <p class="text-muted">{{Auth::user()->alamat}}</p>

        <hr>

        <strong><i class="fa fa-file-text-o margin-r-5"></i> MobsterID</strong>

        <p>{{Auth::user()->mobsterid}}</p>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="settings">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Name</label>

              <div class="col-sm-10">
                <input type="email" class="form-control" id="inputName" placeholder="Name">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Email</label>

              <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Name</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Name">
              </div>
            </div>
            <div class="form-group">
              <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

              <div class="col-sm-10">
                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
@elseif(Auth::user()->status_reseller == "1")
<div class="row">
  <div class="col-md-12">
    <div class="callout callout-success">
      <h4>Akun Anda sudah aktif</h4>

      <p>Untuk memulai broadcast, Anda dapat melihat daftar content yang ada di table Broadcast.</p>
    </div>
  </div>
</div>
@endif

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Broadcast</h3><br>
        <a href="/reseller" class="btn btn-success"> <i class="fa fa-refresh"></i> Refresh</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">

            <table class="table table-hover">
              <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Content</th>
                <th>Asset</th>
              </tr>
              <form class="" id="finish" action="/admin/broadcast/finish" method="post">
              @foreach($data as $c)
                {{csrf_field()}}
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$c->nama}}</td>
                @foreach($c->content as $cnt)
                  <td>{{$cnt->content}}</td>
                  <td> <a href="{!! $cnt->asset !!}">{!! $cnt->asset !!}</a></td>
                @endforeach
              </tr>
              @endforeach
              </form>
            </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>

@endsection
