@extends('layouts.master')

@section('content')

    <div class="container">
        <a href="{{ route( 'test.validasi-data' ) }}" class="btn btn-primary btn-lg pull-right mt-2">
            <i class="fa fa-plus"></i> Kembali
        </a>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="width:100%;">
                    <div class="x_content">                                            
                        <h3 class="mb-3 mt-3">Hasil</h3>
                        
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Row</th>
                                <th>Message</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if (isset($compact['hasil']))
                                    @foreach ($compact['hasil'] as $d => $data)
                                        <tr>
                                            <td>{{ $d }}</td>
                                            <td>{{ $data }}</td>
                                        </tr>
                                    @endforeach                            
                                @endif                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection