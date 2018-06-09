@extends('layouts.utama')

@section('css')
  <link rel="stylesheet" href="{{url('assetdashboard/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('contentheader')
<h1>
  Barang
</h1>
<ol class="breadcrumb">
  <li class="active"><a href="/admin/barang"><i class="fa fa-home"></i> Content</a></li>
</ol>
@endsection

@section('content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data pembelian</h3><br>
        <a href="/admin/pembelian/create" class="btn btn-primary">Create</a>
        <a href="/admin/pembelian" class="btn btn-success"> <i class="fa fa-refresh"></i> Refresh</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Invoice Code</th>
                <th>Nama Konsumen</th>
                <th>No Whatsapp</th>
                <th>Pembayaran</th>
                <th>No Resi</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Harga Akhir</th>
                <th>Status Pembayaran</th>
                <th>Status Pengiriman</th>
                <th>Action</th>
          </tr>
          </thead>
          <tbody>
            @foreach($data as $c)
              <tr>
                <td>@if($c->invoice_code <= 9) 00{{$c->invoice_code}} @elseif($c->invoice_code <= 99) 0{{$c->invoice_code}} @elseif($c->invoice_code <= 999) {{$c->invoice_code}} @endif</td>
                <td>{{$c->nama}}</td>
                <td>{{$c->no_hp}}</td>
                <td>@if($c->pembayaran == "BCA") BCA @elseif($c->pembayaran == "BNI") BNI @elseif($c->pembayaran == "MS") Mandiri Syariah @endif</td>
                <td>{{$c->resi}}</td>
                <td>{{$c->barang['nama_barang']}}</td>
                <td>{{$c->jumlah_barang}}</td>
                <td>Rp. {{$c->hargatotal}}</td>
                <td> @if($c->status == "0")
                  <span class="label label-warning">Pending</span>
                  @elseif($c->status == "1")
                  <span class="label label-success">Lunas</span>
                  @endif</td>
                <td> @if($c->status_pengiriman == "0")
                    <span class="label label-warning">Pending</span>
                    @elseif($c->status_pengiriman == "1")
                    <span class="label label-success">Lunas</span>
                    @endif</td>
                <td><a href="/admin/pembelian/{{$c->invoice_code}}/edit" class="btn btn-warning"> <i class="fa fa-pencil"></i> </a> | <a href="{{url('admin/pembelian/delete',$c->invoice_code)}}" class="btn btn-danger"> <i class="fa fa-trash"></i></a> |
                <a href="https://api.whatsapp.com/send?phone={{$c->no_hp}}&text=Detail pembayaran anda :%0D%0A%0D%0AInvoice code : @if($c->invoice_code <= 9) 00{{$c->invoice_code}} @elseif($c->invoice_code <= 99) 0{{$c->invoice_code}} @elseif($c->invoice_code <= 999) {{$c->invoice_code}} @endif%0D%0ANama: {{$c->nama}}%0D%0AAlamat: {{$c->alamat}}%0D%0ABarang : {{$c->barang['nama_barang']}}%0D%0AJumlah barang : {{$c->jumlah_barang}}%0D%0AJumlah yang harus dibayar : Rp {{$c->hargatotal}}%0D%0A%0D%0AHarap segera bayar sesuai dengan jumlah yang harus dibayar.%0D%0A%0D%0ABCA 4383140377%0D%0ABMS 7140319777%0D%0ABNI 1403197707%0D%0AA.N Mohamad Ali Guntur%0D%0A%0D%0ASilahkan balas pesan ini untuk melakukan konfirmasi pembayaran dengan cara ketik konfirmasi#order dan sertakan bukti transfer.%0D%0A%0D%0ANote : *gambar bukti transfer jangan diberi caption.*" class="btn btn-success"> <i class="fa fa-whatsapp"></i></a></td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
@endsection

@section('js')
<script src="{{url('assetdashboard/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assetdashboard/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script>
$(document).ready(function() {
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    } );
} );
</script>
@endsection
