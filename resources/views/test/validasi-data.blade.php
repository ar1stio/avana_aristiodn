@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="width:100%;">
                    <div class="x_content">                    
                        <form class="form" action="{{ route( 'test.process-excel' ) }}" method="post" enctype="multipart/form-data" novalidate>
                            {{ csrf_field() }}

                            <h3 class="mb-3 mt-3">Test 2</h3>                        

                            <div class="field item form-group @error('importfile') bad @enderror">
                                <label class="col-form-label col-md-2 col-sm-2  label-align">Read Excel<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" class="form-control" name="importfile" id="importdata">                                    
                                </div>
                                @error('importfile')
                                    <small class="error-message">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>                            

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-8 mt-3 pr-0">
                                        <button type='submit' class="btn btn-primary pull-right">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection