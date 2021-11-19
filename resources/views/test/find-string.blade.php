@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel" style="width:100%;">
                    <div class="x_content">
                        <form class="form" action="{{ route( 'test.process-string' ) }}" method="post" novalidate>
                            {{ csrf_field() }}

                            <h3 class="mb-3 mt-3">Test 1</h3>                        

                            <div class="field item form-group">
                                <label class="col-form-label col-md-2 col-sm-2  label-align">String<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control"
                                            name="abjad"
                                            type="text"
                                            id="abjad"
                                            placeholder="a (b c (d e (f) g) h) i (j k)" />
                                    @error('abjad')
                                        <small style="color:red;" class="error-message">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                    <!-- <small>
                                        Field ini tidak bisa diubah
                                    </small> -->
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-2 col-sm-2  label-align">Index<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control"
                                            name="idx"
                                            id="idx"
                                            type="number"
                                            placeholder="Ketikan Angka"
                                             />
                                    <!-- <small>
                                        Field Email tidak dapat diubah
                                    </small> -->
                                    @error('idx')
                                        <small style="color:red;" class="error-message">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
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