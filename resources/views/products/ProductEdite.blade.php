@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"></h4>الاعدادات<span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل منتج</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
@endsection
@section('content')
				<!-- row -->
				<div class="row">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل المنتج</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('product.update',$post->id)}}" autocomplete="off">
                    @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="recipient-name" class="col-form-label">اسم المنتج:</label>
                            <input class="form-control" value ="{{$post->Product_name}}" name="Product_name"  id="Product_name" type="text">
                        </div>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                            <select name="section_id" id="section_id" class="form-control" required>
                                <option value="" selected disabled> --حدد القسم--</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->section_name}}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">ملاحظات:</label>
                            <textarea class="form-control" value ="{{$post->description}}" id="description" name="description">{{$post->description}}</textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تاكيد</button>
                </div>
                </form>
            </div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
