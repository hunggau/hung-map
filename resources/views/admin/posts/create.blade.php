@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Post
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                @include('common.errors')

                <!-- New Task Form -->
                <form action="{{ url('/admin/posts/store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="post-title" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" name="title" id="post-title" class="form-control" 
                                   value="{{old('title')}}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="post-slug" class="col-sm-3 control-label">Slug</label>
                        <div class="col-sm-12">
                            <input type="text" name="slug" id="post-slug" class="form-control" 
                                   value="{{old('slug')}}">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <label for="post-content" class="col-sm-3 control-label">Content</label>
                        <div class="col-sm-12">
                            <textarea name="content" id="post-content"
                            rows="10"
                            class="form-control">{{old('content')}}</textarea>                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="post-status" class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-12">
                            {{ Form::select('status', [                                
                                1 => 'Active',
                                2 => 'Draft',                                
                            ], app('request')->input('status', 2), ['id' => 'statusSl', 
                                        'class ' => 'form-control input-sm']  ) }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="post-title" class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-12">
                            {!! $tree !!}                        
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tags-post" class="col-sm-3 control-label">Tag</label>
                        <div class="col-sm-12">
                            <input type="text" name="tag" class="form-control" 
                                   value="{{old('tag')}}" id="tags-post"/>
                        </div>
                    </div>
                    
                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-6">
                            {{ Form::checkbox('continueEdit', 1, true, []) }}
                            {!! Form::label('Continue edit') !!} <br />
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>Add Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        Post.initSlug();
        Post.initTags();
        Post.initTinymce();
    });
</script>
@endsection