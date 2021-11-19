@extends('layouts.master')

@section('content')

    <div class="container">
        <a href="{{ route( 'test.find-string') }}" class="btn btn-primary btn-lg pull-right mt-2">
            <i class="fa fa-plus"></i> Kembali
        </a>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="width:100%;">
                    <div class="x_content">

                        <h3 class="mb-3 mt-3">Hasil</h3>
                        
                        <div class="field item form-group">
                            <label class="col-form-label col-md-2 col-sm-2  label-align">Hasil Pencarian<span class="required"></span></label>
                            <div class="col-md-6 col-sm-6">
                                <label>{{ isset($compact['hasil'])?$compact['hasil']:'' }}</label>                                                                
                            </div>
                        </div>
                        
                        <div class="field item form-group">
                            <label class="col-form-label col-md-2 col-sm-2  label-align">Total Karakter Pencarian<span class="required"></span></label>
                            <div class="col-md-6 col-sm-6">
                                <label>{{ isset($compact['jumlah'])?$compact['jumlah']:'' }}</label>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection